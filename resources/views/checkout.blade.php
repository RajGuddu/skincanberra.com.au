@extends('_layouts.master')
@section('content')

<div class="container my-2">
  <h2 class="mb-4" style="color:#B4903A;">Checkout</h2>

  <?php if(Session::has('message')){ 
    echo alertBS(session('message')['msg'], session('message')['type']);
  } ?>

  <div class="row">
    <!-- Left side: Cart -->
    <div class="col-md-6">
      <h5 style="color:#B4903A;">Your Cart</h5>
      <?php $total = 0; 
        if (cart()->getTotalQuantity() === 0): ?>
      <div class="alert alert-danger">Your cart is empty</div>

      <?php else: 
          $cart = cart()->getItems();
        ?>
      <table class="table table-bordered align-middle">
        <thead style="background-color:#F8F1E7; color:#4A2C10;">
          <tr>
            <th>Image</th>
            <th>Product Name</th>
            <th width="100">Qty</th>
            <th width="120">Price</th>
            <th width="120">Subtotal</th>
            <th width="80">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($cart as $item): ?>
          <tr>
            <td>
              <img src="<?= url(IMAGE_PATH.$item['attributes']['image']) ?>" alt="<?= $item['name'] ?>"
                style="width:70px; height:70px; object-fit:cover; border-radius:8px;">
            </td>
            <td>
              <strong>
                <?= $item['name'] ?>
              </strong>
            </td>
            <td>
              <?= $item['quantity'] ?>
            </td>
            <td>$
              <?= number_format($item['price'], 2) ?>
            </td>
            <td>$
              <?= number_format($item->getPriceSum(), 2) ?>
            </td>
            <td class="text-center">
              <a href="{{ url('remove-item/'.$item['id']) }}" class="btn btn-sm"
                style="background-color:#B4903A; color:white;" onclick="return confirm('Remove this item from cart?')">
                Remove
              </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="4" class="text-end" style="color:#4A2C10;">Total</th>
            <th colspan="2" style="color:#B4903A;">$
              <?= number_format(cart()->getTotal(), 2) ?>
            </th>
          </tr>
        </tfoot>
      </table>
      <?php endif; ?>

      <a href="<?=url('/')?>" class="btn" style="background-color:#B4903A; color:white; margin-top:1rem;">
        Continue Shopping
      </a>
    </div>

    <!-- Right side: Delivery Address -->
    <div class="col-md-6">
      <h5 style="color:#B4903A;">Select Delivery Address</h5>
      <form action="<?= url('checkout') ?>" method="post" class="mt-3">
        @csrf

        <!-- Saved Address List -->
        <div class="list-group mb-3">
          <?php if(isset($addresses) && $addresses->isNotEmpty()):
          foreach ($addresses as $addr): ?>
          <label class="list-group-item d-flex align-items-start">
            <input type="radio" name="address_option" value="<?= $addr->add_id ?>" class="form-check-input me-3" required>
            <div>
              <div class="fw-bold">
                <?= $addr->name ?> (
                <?= $addr->phone ?>)
              </div>
              <small class="text-muted">
                <?= $addr->address ?>
              </small>
            </div>
          </label>
          <?php endforeach; endif;?>

          <!-- Option for new address -->
          <label class="list-group-item d-flex align-items-start">
            <input type="radio" name="address_option" value="new" class="form-check-input me-3" checked>
            <div>
              <div class="fw-bold">Use New Address</div>
              <small class="text-muted">Enter details below</small>
            </div>
          </label>
        </div>

        <!-- New Address Form -->
        <div id="newAddressFields" class="mt-3">
          <div class="mb-3">
            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" id="name" value="<?=old('name')?>">
            @error('name') <span class="text-danger"> {{ $message }} </span> @enderror
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
            <input type="text" name="phone" class="form-control" id="phone" value="<?=old('phone')?>">
            @error('phone') <span class="text-danger"> {{ $message }} </span> @enderror
          </div>

          <div class="mb-3">
            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
            <textarea name="address" class="form-control" id="address" rows="3"><?=old('address')?></textarea>
            @error('address') <span class="text-danger"> {{ $message }} </span> @enderror
          </div>
        </div>

        <?php /* <button type="submit" class="btn w-100" style="background-color:#B4903A; color:white;">
          Place Order (COD)
        </button> */ ?>
        <button type="submit" class="btn w-100" style="background-color:#B4903A; color:white;">
          Place Order ($<?= number_format(cart()->getTotal(), 2) ?>)
        </button>
      </form>
    </div>


  </div>
</div>

@endsection