var calendar = {

	init: function(ajax, url) {

		if (ajax) {

      // ajax call to print json
      $.ajax({
  				//url: 'https://ceonpoint.com/roadtraffic/assets/event_calender/data/events.json',
  				url: url,
  				type: 'GET',
				dataType: 'json',
  			})
  			.done(function(data) {
			//console.log(data); return 0;
			//alert(data);return 0;
		if(data.result == undefined){
          var events = data.events;
          // loop json & append to dom
          for (var i = 0; i < events.length; i++) {
			//alert(events[i].day + events[i].month + events[i].year); return 0;
            $('.list').append('<div class="day-event" date-day="'+ events[i].day +'" date-month="' + events[i].month +'" date-year="'+ events[i].year +'" data-number="'+ i +'" data-es_id="'+ events[i].es_id +'" data-title="'+ events[i].title +'" data-venue="'+ events[i].venue +'" data-reg_start_date="'+ events[i].reg_start_date +'" data-reg_end_date="'+ events[i].reg_end_date +'" data-workingdays="'+ events[i].workingdays +'" data-holiday="'+ events[i].holiday +'" data-others="'+ events[i].others +'"></div>');
          }
		}

          // start calendar
          calendar.startCalendar();

  			})
  			.fail(function(data) {
  				console.log(data);
  			});
		} else {

      // if not using ajax start calendar
      calendar.startCalendar();
    }

	},

  startCalendar: function() {
    var mon = 'Mon';
		var tue = 'Tue';
		var wed = 'Wed';
		var thur = 'Thur';
		var fri = 'Fri';
		var sat = 'Sat';
		var sund = 'Sun';

		/**
		 * Get current date
		 */
		var d = new Date();
		var strDate = yearNumber + "/" + (d.getMonth() + 1) + "/" + d.getDate();
		var yearNumber = (new Date).getFullYear();
		/**
		 * Get current month and set as '.current-month' in title
		 */
		var monthNumber = d.getMonth() + 1;

		function GetMonthName(monthNumber) {
			var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
			return months[monthNumber - 1];
		}

		setMonth(monthNumber, mon, tue, wed, thur, fri, sat, sund);

		function setMonth(monthNumber, mon, tue, wed, thur, fri, sat, sund) {
			$('.month').text(GetMonthName(monthNumber) + ' ' + yearNumber);
			$('.month').attr('data-month', monthNumber);
			printDateNumber(monthNumber, mon, tue, wed, thur, fri, sat, sund);
		}

		$('.btn-next').on('click', function(e) {
			var monthNumber = $('.month').attr('data-month');
			if (monthNumber > 11) {
				$('.month').attr('data-month', '0');
				var monthNumber = $('.month').attr('data-month');
				yearNumber = yearNumber + 1;
				setMonth(parseInt(monthNumber) + 1, mon, tue, wed, thur, fri, sat, sund);
			} else {
				setMonth(parseInt(monthNumber) + 1, mon, tue, wed, thur, fri, sat, sund);
			};
		});

		$('.btn-prev').on('click', function(e) {
			var monthNumber = $('.month').attr('data-month');
			if (monthNumber < 2) {
				$('.month').attr('data-month', '13');
				var monthNumber = $('.month').attr('data-month');
				yearNumber = yearNumber - 1;
				setMonth(parseInt(monthNumber) - 1, mon, tue, wed, thur, fri, sat, sund);
			} else {
				setMonth(parseInt(monthNumber) - 1, mon, tue, wed, thur, fri, sat, sund);
			};
		});

		/**
		 * Get all dates for current month
		 */

		function printDateNumber(monthNumber, mon, tue, wed, thur, fri, sat, sund) {

			$($('tbody.event-calendar tr')).each(function(index) {
				$(this).empty();
			});

			$($('thead.event-days tr')).each(function(index) {
				$(this).empty();
			});

			function getDaysInMonth(month, year) {
				// Since no month has fewer than 28 days
				var date = new Date(year, month, 1);
				var days = [];
				while (date.getMonth() === month) {
					days.push(new Date(date));
					date.setDate(date.getDate() + 1);
				}
				return days;
			}

			i = 0;

			setDaysInOrder(mon, tue, wed, thur, fri, sat, sund);

			function setDaysInOrder(mon, tue, wed, thur, fri, sat, sund) {
				var monthDay = getDaysInMonth(monthNumber - 1, yearNumber)[0].toString().substring(0, 3);
				$('thead.event-days tr').append('<td>' + mon + '</td><td>' + tue + '</td><td>' + wed + '</td><td>' + thur + '</td><td>' + fri + '</td><td>' + sat + '</td><td>' + sund + '</td>');
				/*if (monthDay === 'Mon') {
					$('thead.event-days tr').append('<td>' + mon + '</td><td>' + tue + '</td><td>' + wed + '</td><td>' + thur + '</td><td>' + fri + '</td><td>' + sat + '</td><td>' + sund + '</td>');
				} else if (monthDay === 'Tue') {
					$('thead.event-days tr').append('<td>' + tue + '</td><td>' + wed + '</td><td>' + thur + '</td><td>' + fri + '</td><td>' + sat + '</td><td>' + sund + '</td><td>' + mon + '</td>');
				} else if (monthDay === 'Wed') {
					$('thead.event-days tr').append('<td>' + wed + '</td><td>' + thur + '</td><td>' + fri + '</td><td>' + sat + '</td><td>' + sund + '</td><td>' + mon + '</td><td>' + tue + '</td>');
				} else if (monthDay === 'Thu') {
					$('thead.event-days tr').append('<td>' + thur + '</td><td>' + fri + '</td><td>' + sat + '</td><td>' + sund + '</td><td>' + mon + '</td><td>' + tue + '</td><td>' + wed + '</td>');
				} else if (monthDay === 'Fri') {
					$('thead.event-days tr').append('<td>' + fri + '</td><td>' + sat + '</td><td>' + sund + '</td><td>' + mon + '</td><td>' + tue + '</td><td>' + wed + '</td><td>' + thur + '</td>');
				} else if (monthDay === 'Sat') {
					$('thead.event-days tr').append('<td>' + sat + '</td><td>' + sund + '</td><td>' + mon + '</td><td>' + tue + '</td><td>' + wed + '</td><td>' + thur + '</td><td>' + fri + '</td>');
				} else if (monthDay === 'Sun') {
					$('thead.event-days tr').append('<td>' + sund + '</td><td>' + mon + '</td><td>' + tue + '</td><td>' + wed + '</td><td>' + thur + '</td><td>' + fri + '</td><td>' + sat + '</td>');
				}*/
			};
			function getDaysNumber(dayName){
				if(dayName === 'Mon'){
					return 0;
				}else if(dayName === 'Tue'){
					return 1;
				}else if(dayName === 'Wed'){
					return 2;
				}else if(dayName === 'Thu'){
					return 3;
				}else if(dayName === 'Fri'){
					return 4;
				}else if(dayName === 'Sat'){
					return 5;
				}else if(dayName === 'Sun'){
					return 6;
				}

			};
			var monthDay = getDaysInMonth(monthNumber - 1, yearNumber)[0].toString().substring(0, 3);
			var dayNum = getDaysNumber(monthDay);
			for(var q=0; q<dayNum; q++){
				$('tbody.event-calendar tr.1').append('<td></td>');
			}
			//alert(dayNum); return 0;
			$(getDaysInMonth(monthNumber - 1, yearNumber)).each(function(index, element) {
				var index = index + 1;
				
				if (index < 8 - dayNum) {
					$('tbody.event-calendar tr.1').append('<td date-month="' + monthNumber + '" date-day="' + index + '" date-year="' + yearNumber + '">' + index + '</td>');
				} else if (index < 15 - dayNum) {
					$('tbody.event-calendar tr.2').append('<td date-month="' + monthNumber + '" date-day="' + index + '" date-year="' + yearNumber + '">' + index + '</td>');
				} else if (index < 22 - dayNum) {
					$('tbody.event-calendar tr.3').append('<td date-month="' + monthNumber + '" date-day="' + index + '" date-year="' + yearNumber + '">' + index + '</td>');
				} else if (index < 29 - dayNum) {
					$('tbody.event-calendar tr.4').append('<td date-month="' + monthNumber + '" date-day="' + index + '" date-year="' + yearNumber + '">' + index + '</td>');
				} else if (index < 36 - dayNum) {
					$('tbody.event-calendar tr.5').append('<td date-month="' + monthNumber + '" date-day="' + index + '" date-year="' + yearNumber + '">' + index + '</td>');
				} else if (index < 38 - dayNum) {
					$('tbody.event-calendar tr.6').append('<td date-month="' + monthNumber + '" date-day="' + index + '" date-year="' + yearNumber + '">' + index + '</td>');
				}
				i++;
			});
			var date = new Date();
			var month = date.getMonth() + 1;
			var thisyear = new Date().getFullYear();
			setCurrentDay(month, thisyear);
			setEvent();
			displayEvent();
		}

		/**
		 * Get current day and set as '.current-day'
		 */
		function setCurrentDay(month, year) {
			var viewMonth = $('.month').attr('data-month');
			var eventYear = $('.event-days').attr('date-year');
			if (parseInt(year) === yearNumber) {
				if (parseInt(month) === parseInt(viewMonth)) {
					$('tbody.event-calendar td[date-day="' + d.getDate() + '"]').addClass('current-day');
				}
			}
		};

		/**
		 * Add class '.active' on calendar date
		 */
		$('tbody td').on('click', function(e) {
			if($(this).hasClass('event')) {
				$('tbody.event-calendar td').removeClass('active');
				$(this).addClass('active');
			} else {
				$('tbody.event-calendar td').removeClass('active');
			};
		});

		/**
		 * Add '.event' class to all days that has an event
		 */
		function setEvent() {
			$('.day-event').each(function(i) {
				var eventMonth = $(this).attr('date-month');
				var eventDay = $(this).attr('date-day');
				var eventYear = $(this).attr('date-year');
				var eventClass = $(this).attr('event-class');
				var es_id = $(this).attr('data-es_id');
				var title = $(this).attr('data-title');
				var venue = $(this).attr('data-venue');
				var reg_start_date = $(this).attr('data-reg_start_date');
				var reg_end_date = $(this).attr('data-reg_end_date');
				var workingdays = $(this).attr('data-workingdays');
				var holiday = $(this).attr('data-holiday');
				var others = $(this).attr('data-others');
				if (eventClass === undefined) eventClass = 'event';
				else eventClass = 'event ' + eventClass;

				if (parseInt(eventYear) === yearNumber) {
					$('tbody.event-calendar tr td[date-month="' + eventMonth + '"][date-day="' + eventDay + '"]').addClass(eventClass).attr('data-es_id', es_id).attr('data-title', title).attr('data-venue', venue).attr('data-reg_start_date', reg_start_date).attr('data-reg_end_date', reg_end_date).attr('data-workingdays', workingdays).attr('data-holiday', holiday).attr('data-others', others);
				}
			});
		};

		/**
		 * Get current day on click in calendar
		 * and find day-event to display
		 */
		function displayEvent() {
			$('tbody.event-calendar td').on('click', function(e) {
				var month = $(this).attr('date-month');
				var day = $(this).attr('date-day');
				var year = $(this).attr('date-year');
				var es_id = $(this).attr('data-es_id');
				var title = $(this).attr('data-title');
				var venue = $(this).attr('data-venue');
				var reg_start_date = $(this).attr('data-reg_start_date');
				var reg_end_date = $(this).attr('data-reg_end_date');
				var workingdays = $(this).attr('data-workingdays');
				var holiday = $(this).attr('data-holiday');
				var others = $(this).attr('data-others');
				if(es_id){
					$("#title").html(title+'<br>'+GetMonthName(parseInt(month))+' '+day+', '+year);
					$("#es_id").val(es_id);
					if(workingdays == 'yes'){
						$("#venue").html('Venue : '+venue);
						$("#regstdate").html('Registration Starts : '+reg_start_date);
						$("#regendate").html('Registration Ends : '+reg_end_date);
						//$("#time").html(start_time+' To '+end_time);
						$.ajax({
							type: "POST",
							url: "https://guyanart.ceonpointllc.com/driver/get_time_schedule",
							data:{es_id:es_id},
							success: function(result){
								$("#timeschedule").html(result);
							}
						});
						$("#wdyes").show();
						$("#wdno").hide();
					}else{
						if(holiday != ''){
							$("#holiday").html(holiday);
						}else{
							$("#others").html(others);
						}
						$("#wdyes").hide();
						$("#wdno").show();
					}
					$("#bookedSlot").modal("show");
				}
				//$('.day-event[date-month="' + monthEvent + '"][date-day="' + dayEvent + '"]').slideDown('fast');
			});
			
		};

		/**
		 * Close day-event
		 */
		$('.close').on('click', function(e) {
			$(this).parent().slideUp('fast');
		});

		/**
		 * Save & Remove to/from personal list
		 */
		$('.save').click(function() {
			if (this.checked) {
				$(this).next().text('Remove from personal list');
				var eventHtml = $(this).closest('.day-event').html();
				var eventMonth = $(this).closest('.day-event').attr('date-month');
				var eventDay = $(this).closest('.day-event').attr('date-day');
				var eventNumber = $(this).closest('.day-event').attr('data-number');
				$('.person-list').append('<div class="day" date-month="' + eventMonth + '" date-day="' + eventDay + '" data-number="' + eventNumber + '" style="display:none;">' + eventHtml + '</div>');
				$('.day[date-month="' + eventMonth + '"][date-day="' + eventDay + '"]').slideDown('fast');
				$('.day').find('.close').remove();
				$('.day').find('.save').removeClass('save').addClass('remove');
				$('.day').find('.remove').next().addClass('hidden-print');
				remove();
				sortlist();
			} else {
				$(this).next().text('Save to personal list');
				var eventMonth = $(this).closest('.day-event').attr('date-month');
				var eventDay = $(this).closest('.day-event').attr('date-day');
				var eventNumber = $(this).closest('.day-event').attr('data-number');
				$('.day[date-month="' + eventMonth + '"][date-day="' + eventDay + '"][data-number="' + eventNumber + '"]').slideUp('slow');
				setTimeout(function() {
					$('.day[date-month="' + eventMonth + '"][date-day="' + eventDay + '"][data-number="' + eventNumber + '"]').remove();
				}, 1500);
			}
		});

		function remove() {
			$('.remove').click(function() {
				if (this.checked) {
					$(this).next().text('Remove from personal list');
					var eventMonth = $(this).closest('.day').attr('date-month');
					var eventDay = $(this).closest('.day').attr('date-day');
					var eventNumber = $(this).closest('.day').attr('data-number');
					$('.day[date-month="' + eventMonth + '"][date-day="' + eventDay + '"][data-number="' + eventNumber + '"]').slideUp('slow');
					$('.day-event[date-month="' + eventMonth + '"][date-day="' + eventDay + '"][data-number="' + eventNumber + '"]').find('.save').attr('checked', false);
					$('.day-event[date-month="' + eventMonth + '"][date-day="' + eventDay + '"][data-number="' + eventNumber + '"]').find('span').text('Save to personal list');
					setTimeout(function() {
						$('.day[date-month="' + eventMonth + '"][date-day="' + eventDay + '"][data-number="' + eventNumber + '"]').remove();
					}, 1500);
				}
			});
		}

		/**
		 * Sort personal list
		 */
		function sortlist() {
			var personList = $('.person-list');

			personList.find('.day').sort(function(a, b) {
				return +a.getAttribute('date-day') - +b.getAttribute('date-day');
			}).appendTo(personList);
		}

		/**
		 * Print button
		 */
		$('.print-btn').click(function() {
			window.print();
		});
  },

};


