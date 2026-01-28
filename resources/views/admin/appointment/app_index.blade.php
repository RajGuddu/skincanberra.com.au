@extends('admin._layout.master')
@section('content')

<style>
  #calendarTable thead th {
    background-color: #e0f7ff;
    color: #000;
  }

  #calendarTable tbody td:first-child,
  #calendarTable thead th:first-child {
    background-color: #e0f7ff;
    color: #000;
    font-weight: 500;
  }

  .closed-day {
    background: repeating-linear-gradient(45deg,
        rgba(255, 0, 0, 0.08),
        rgba(255, 0, 0, 0.08) 2px,
        rgba(255, 0, 0, 0.15) 2px,
        rgba(255, 0, 0, 0.15) 4px);
  }

  .appointment-link {
    color: #fff;
    text-decoration: underline;
    cursor: pointer;
  }

  .appointment-link:hover {
    text-decoration: none;
    color: #e0e0e0;
  }
  .badge-tiny {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.65rem;      
    padding: 0.12rem 0.28rem;
    line-height: 1;
    border-radius: 0.25rem;  
    min-width: 1.0rem;      
    height: 1.0rem;
    box-sizing: border-box;
    vertical-align: middle;
  }
  .table-fixed {
      width: 100%;
      table-layout: fixed;   
      word-wrap: break-word; 
  }
</style>

<div class="app-content pt-3 p-md-3 p-lg-4">

  @php
    $tableCol = 12; $formCol = 0; $colClass="d-none";
    if(isset($record))
      { $tableCol = 9; $formCol = 3; $colClass=""; }
  @endphp
  

  <div class="container-fluid">
    <?php if(Session::has('message')){ 
			echo alertBS(session('message')['msg'], session('message')['type']);
		} ?>
    <div class="row">
      <div class="col-lg-{{ $tableCol }}">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h1 class="app-page-title mb-0">Weekly Schedule</h1>
          <div>
            <button class="btn btn-sm btn-outline-secondary me-2" id="prevWeek">◀ Prev</button>
            <span id="weekRange" class="fw-bold"></span>
            <button class="btn btn-sm btn-outline-secondary ms-2" id="nextWeek">Next ▶</button>
          </div>
        </div>

        <div class="table-responsive border ">
          <table class="table table-bordered text-center table-fixed mb-0" id="calendarTable">
            <thead class="table-light">
              <tr id="dayHeader">
                <th style="width:100px;">Time</th>
              </tr>
            </thead>
            <tbody id="calendarBody"></tbody>
          </table>
        </div>
      </div>

      <div class="col-lg-{{ $formCol }} {{ $colClass }}" >
        <div class="card shadow-sm">
          <div class="card-header bg-light fw-bold">
            Edit Appointment
          </div>
          <div class="card-body">
            <form action="{{ url()->current() }}" id="appointmentForm" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $record->id ?? '' }}">
            
            <!-- Client Info Box -->
            <div class="p-3 rounded mb-3 shadow-sm"
                style="background: #087e5eff; color: #e3fff8; border-left: 4px solid #4ef6c7;">

                <h5 class="mb-1" style="font-weight:600; color:#4ef6c7;">
                    {{ $record->first_name ?? '' }} {{ $record->last_name ?? '' }}
                </h5>

                <div style="font-size:14px; line-height:1.5;">
                    
                    <span style="color:#b8f9e5;">Phone:</span> {{ $record->phone ?? 'N/A' }} <br>
                    <span style="color:#b8f9e5;">Email:</span> {{ $record->email ?? 'N/A' }} <br>
                    @if(isset($record) && $record->dob != null)
                    <span style="color:#b8f9e5;">DOB:</span> {{ date('d M,Y',strtotime($record->dob)) ?? 'N/A' }} <br>
                    @endif
                    <span style="color:#b8f9e5;">Service:</span> {{ $record->service_name ?? 'N/A' }} ({{ $record->variant ?? 'N/A' }})<br>
                    <span style="color:#b8f9e5;">Duration :</span> {{ $record->duration ?? 'N/A' }} Minutes<br>
                    <!-- <span style="color:#b8f9e5;">Price :</span> ${{ $record->price ?? 'N/A' }} -->
                    <li class="list-group-item">
                        <span style="color:#b8f9e5;">Total Amount :</span> ${{ $record->total_amount ?? 'N/A' }}
                        <span style="color:#b8f9e5;">Total Paid :</span> ${{ $record->paid_amount ?? 'N/A' }}
                        <span style="color:#b8f9e5;">Total Dues :</span> ${{ $record->dues_amount ?? 'N/A' }}
                    </li>

                </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Service Date</label>
              <input type="date" name="service_date" value="{{ old('service_date', $record->service_date ?? '') }}" id="serviceDate" class="form-control">
              <input type="hidden" name="old_service_date" value="{{ $record->service_date ?? '' }}" >
            </div>

            <div class="mb-3">
              <label class="form-label">Service Time</label>
              <select id="serviceTime" name="st_id" class="form-select">
                @if(isset($availableTimes) && $availableTimes->isNotEmpty())
                @foreach($availableTimes as $list)
                  @php 
                  $selected = '';
                  if(isset($record) && $record->st_id == $list->st_id){
                    $selected = 'selected';
                  }
                  @endphp
                  <option value="{{ $list->st_id }}" {{ $selected }}>{{ $list->serv_time }}</option>
                @endforeach
                
                @endif
              </select>
              <input type="hidden" name="old_st_id" value="{{ $record->st_id ?? '' }}" >

            </div>

            <div class="mb-3">
              <label class="form-label">Status</label>
              <select id="status" class="form-select" name="status">
                <option value="1" {{ (isset($record) && $record->status == 1)?'selected':'' }}>Pending</option>
                <option value="2" {{ (isset($record) && $record->status == 2)?'selected':'' }}>Approved</option>
                <option value="3" {{ (isset($record) && $record->status == 3)?'selected':'' }}>Declined</option>
                <option value="4" {{ (isset($record) && $record->status == 4)?'selected':'' }}>Completed</option>
              </select>
              <input type="hidden" name="old_status" value="{{ $record->status ?? '' }}" >
            </div>

            <button class="btn btn-primary  text-white" id="saveService">Save</button>
            <a href="{{ url('admin/appointment') }}" class="btn btn-secondary text-white" id="">Cancel</a>
            </form>
          </div>
        </div>
      </div>


    </div>

  </div>
</div>



<!--  Appointment Detail Modal -->
<div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title text-white" id="appointmentModalLabel">Appointment Details</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <li class="list-group-item"><strong>Name:</strong> <span id="modalName"></span></li>
          <li class="list-group-item"><strong>Service:</strong> <span id="modalService"></span></li>
          <li class="list-group-item"><strong>Variant:</strong> <span id="modalVariant"></span></li>
          <li class="list-group-item"><strong>Date:</strong> <span id="modalDate"></span></li>
          <li class="list-group-item"><strong>Start Time:</strong> <span id="modalStart"></span></li>
          <li class="list-group-item"><strong>Duration:</strong> <span id="modalDuration"></span> minutes</li>
          <!-- <li class="list-group-item"><strong>Price:</strong> <span id="modalPrice"></span> </li> -->
          <li class="list-group-item d-flex justify-content-between">
              <span><strong>Total Amount:</strong> $<span id="totalAmount"></span></span>
              <span><strong>Total Paid:</strong> $<span id="totalPaid"></span></span>
              <span><strong>Total Dues:</strong> $<span id="totalDues"></span></span>
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>
  $('#serviceDate').on('change', function () {
    let selectedDate = $(this).val();

    if (selectedDate === '') return;

    // Show loading
    $('#serviceTime').html('<option>Loading...</option>');

    $.ajax({
        url: "{{ url('admin/get-times-by-date') }}",
        type: "GET",
        data: { date: selectedDate },
        success: function (response) {

            // Clear dropdown
            $('#serviceTime').empty();

            if (response.length > 0) {
              $('#serviceTime').html(response);
                
            } else {
              $('#serviceTime').append('<option>No slots available</option>');
            }
        }
    });
  });

  $(document).ready(function() {

    $('#saveService').on('click', function (e) {
        e.preventDefault(); // stop form submit

        let isValid = true;
        let errors = [];

        // Get values
        let serviceDate = $('#serviceDate').val().trim();
        let serviceTime = $('#serviceTime').val();
        let status = $('#status').val();

        // Reset previous errors
        $('.is-invalid').removeClass('is-invalid');

        // Validate Date
        if (serviceDate === "") {
            isValid = false;
            errors.push("Please select service date.");
            $('#serviceDate').addClass('is-invalid');
        }

        // Validate Time
        if (serviceTime === "" || serviceTime === null) {
            isValid = false;
            errors.push("Please select service time.");
            $('#serviceTime').addClass('is-invalid');
        }

        // Validate Status
        if (status === "" || status === null) {
            isValid = false;
            errors.push("Please select status.");
            $('#status').addClass('is-invalid');
        }

        // Show errors if any
        if (!isValid) {
            let errorMsg = errors.join("<br>");
            showErrorToast(errorMsg);  // Optional toast message (below)
            return;
        }

        // All good → submit form
        $('#appointmentForm').submit();
    });

  });

// Optional simple toast notification
function showErrorToast(msg) {
    let toast = `
        <div class="toast align-items-center text-bg-danger border-0 show"
             style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
            <div class="d-flex">
                <div class="toast-body">${msg}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
            </div>
        </div>`;

    $('body').append(toast);

    setTimeout(() => {
        $('.toast').remove();
    }, 3000);
}

</script>

<script>
  const startHour = 10;
  const endHour = 18;
  const slotMinutes = 15;
  const colors = ["#198754", "#0d6efd", "#ffc107", "#20c997", "#fd7e14"];

  /*const appointments = [
    { name: "Jane Gomes", service: "Tint Roots Only", date: "2025-11-12", start: "10:00", duration: 16, price: "$140" },
    { name: "Sara Asif", service: "Skin Needling", date: "2025-11-13", start: "11:15", duration: 30, price: "$150" },
    { name: "Sunaina Sunaina", service: "Hydra Facial", date: "2025-11-15", start: "12:00", duration: 60, price: "$160" },
    { name: "Ann Mary", service: "IPL One Sitting", date: "2025-11-17", start: "15:45", duration: 15, price: "$170" },
    { name: "Mehjabeen", service: "Makeup", date: "2025-11-14", start: "10:30", duration: 45, price: "$180" },
  ]; */
  const appointments = {!! $appointments !!};
  // console.log(appointments);

  // 0 = Sunday, ... 6 = Saturday
  let weeklyHolidays = "{{ $settings->weeklyHolidays ?? '' }}";
  const closedDays = weeklyHolidays ? weeklyHolidays.split(',').map(Number) : [];
  // console.log(closedDays[1]);
  // alert(closedDays);

  let currentWeekStart = getMonday(new Date());
  renderCalendar();

  document.getElementById('prevWeek').onclick = () => {
    currentWeekStart.setDate(currentWeekStart.getDate() - 7);
    renderCalendar();
  };
  document.getElementById('nextWeek').onclick = () => {
    currentWeekStart.setDate(currentWeekStart.getDate() + 7);
    renderCalendar();
  };

  function renderCalendar() {
    const headerRow = document.getElementById('dayHeader');
    const body = document.getElementById('calendarBody');
    const weekRange = document.getElementById('weekRange');

    headerRow.innerHTML = '<th>Time</th>';
    body.innerHTML = '';

    const weekDates = [];
    for (let i = 0; i < 7; i++) {
      const d = new Date(currentWeekStart);
      d.setDate(d.getDate() + i);
      const dateStr = d.toISOString().split('T')[0];
      const dayNumber = d.getDay();
      weekDates.push({ dateStr, dayNumber });

      // const label = d.toLocaleDateString('en-GB', { weekday: 'short', day: '2-digit', month: 'short' });
      // headerRow.innerHTML += `<th>${label}</th>`;

      const labelDate = d.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
      const labelDay = d.toLocaleDateString('en-GB', { weekday: 'long' });
      headerRow.innerHTML += `<th>${labelDate}<br><small>${labelDay}</small></th>`;

    }

    const startStr = new Date(weekDates[0].dateStr).toLocaleDateString('en-GB');
    const endStr = new Date(weekDates[6].dateStr).toLocaleDateString('en-GB');
    weekRange.textContent = `${startStr} - ${endStr}`;

    const totalSlots = ((endHour - startHour) * 60) / slotMinutes;
    for (let slot = 0; slot < totalSlots; slot++) {
      const row = document.createElement('tr');
      const hour = startHour + Math.floor((slot * slotMinutes) / 60);
      const mins = (slot * slotMinutes) % 60;

      const timeCell = document.createElement('td');
      timeCell.textContent = formatHour(hour, mins);
      row.appendChild(timeCell);

      weekDates.forEach(({ dateStr, dayNumber }) => {
        const cell = document.createElement('td');
        cell.style.height = '35px';
        cell.dataset.date = dateStr;
        cell.dataset.time = `${hour.toString().padStart(2, '0')}:${mins.toString().padStart(2, '0')}`;
        cell.dataset.day = dayNumber;

        if (closedDays.includes(dayNumber)) {
          cell.classList.add('closed-day');
        }
        row.appendChild(cell);
      });
      body.appendChild(row);
    }

    renderAppointments(weekDates);
  }

  function renderAppointments(weekDates) {
    let colorIndex = 0;
    appointments.forEach((a, idx) => {
      const match = weekDates.find(d => d.dateStr === a.date);
      if (!match) return;
      if (closedDays.includes(match.dayNumber)) return;

      const color = colors[colorIndex % colors.length];
      colorIndex++;

      const [startH, startM] = a.start.split(':').map(Number);
      const startIndex = ((startH - startHour) * 60 + startM) / slotMinutes;
      const slotsNeeded = Math.ceil(a.duration / slotMinutes);

      for (let s = 0; s < slotsNeeded; s++) {
        const slotIndex = startIndex + s;
        const row = document.querySelectorAll('#calendarBody tr')[slotIndex];
        if (!row) continue;
        const cell = row.querySelector(`td[data-date="${a.date}"]`);
        if (cell && !cell.classList.contains('closed-day')) {
          cell.style.backgroundColor = color;
          cell.style.color = 'white';
          if (s === 0) {
            const editURL = "{{ url('admin/appointment') }}" + '/' + a.book_id;
            let status = 'Pending';
            if(a.status == 2){
              status = 'Approved';
            }else if(a.status == 3){
              status = 'Declined';
            }else if(a.status == 4){
              status = 'Completed';
            }

            cell.innerHTML = `
            <div class="fw-bold small">
              <a class="appointment-link" data-index="${idx}" data-bs-toggle="modal" data-bs-target="#appointmentModal">
                ${a.name}
              </a>
            </div>
            <div class="small">${a.service}</div>
            <div class="small"><span class="badge badge-tiny bg-white text-secondary me-2">${status}</span><a href="${editURL}" class="appointment-link">Edit</a></div>
          `;
          }
        }
      }
    });

    //  Event delegation for modal
    document.querySelectorAll('.appointment-link').forEach(link => {
      link.addEventListener('click', e => {
        const index = e.target.getAttribute('data-index');
        const appt = appointments[index];
        showAppointmentDetails(appt);
      });
    });
  }

  function showAppointmentDetails(appt) {
    const time12 = new Date("2000-01-01 " + appt.start).toLocaleTimeString([], {
      hour: "2-digit",
      minute: "2-digit",
      hour12: true
    });
    document.getElementById('modalName').textContent = appt.name;
    document.getElementById('modalService').textContent = appt.service;
    document.getElementById('modalVariant').textContent = appt.variant;
    document.getElementById('modalDate').textContent = new Date(appt.date).toLocaleDateString('en-GB');
    document.getElementById('modalStart').textContent = time12;
    document.getElementById('modalDuration').textContent = appt.duration;
    // document.getElementById('modalPrice').textContent = appt.price;
    document.getElementById('totalAmount').textContent = appt.total_amount;
    document.getElementById('totalPaid').textContent = appt.paid_amount;
    document.getElementById('totalDues').textContent = appt.dues_amount;
  }

  function formatHour(h, m) {
    const ampm = h >= 12 ? 'PM' : 'AM';
    const hour12 = h > 12 ? h - 12 : h;
    return `${hour12.toString().padStart(2, '0')}:${m.toString().padStart(2, '0')} ${ampm}`;
  }

  function getMonday(d) {
    const date = new Date(d);
    const day = date.getDay();
    const diff = date.getDate() - day + (day === 0 ? -6 : 1);
    return new Date(date.setDate(diff));
  }
  // calendar end
  


</script>

@endsection