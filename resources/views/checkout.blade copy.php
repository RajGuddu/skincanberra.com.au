@extends('_layouts.master')
@section('content')


<div class="container my-5">
  <h2 class="mb-4">Checkout</h2>
  <?php if(Session::has('message')){ 
    echo alertBS(session('message')['msg'], session('message')['type']);
  } ?>

  <div class="row">
    <div class="col-md-6">
      <h5>Your Cart</h5>
        <?php $total = 0; 
        if (cart()->getTotalQuantity() === 0): ?>
          <div class="alert alert-danger">Your cart is empty</div>
          
        <?php else: 
          $cart = cart()->getItems();
        ?>
          <table class="table table-bordered align-middle">
            <thead class="table-light">
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
                            <img src="<?= url(IMAGE_PATH.$item['attributes']['image']) ?>" 
                                alt="<?= $item['name'] ?>" 
                                style="width:70px; height:70px; object-fit:cover; border-radius:8px;">
                        </td>
                        <td>
                            <strong><?= $item['name'] ?></strong><br>
                            <?php /* <small class="text-muted">ID: <?= $item->id ?></small> */ ?>
                        </td>
                        <td><?= $item['quantity'] ?></td>
                        <td>$<?= number_format($item['price'], 2) ?></td>
                        <td>$<?= number_format($item->getPriceSum(), 2) ?></td>
                        <td class="text-center">
                          <a href="{{ url('remove-item/'.$item['id']) }}" class="btn  btn-danger" onclick="return confirm('Remove this item from cart?')">
                            Remove
                          </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-end">Total</th>
                    <th>$<?= number_format(cart()->getTotal(), 2) ?></th>
                </tr>
            </tfoot>
        </table>
        <?php endif; ?>
      <a href="<?=url('/')?>" class="btn btn-primary my-4">Continue Shoping</a>
    </div>

    <div class="col-md-6">
      <h5>Customer Information</h5>
      <form action="<?=url('checkout')?>" method="post">
        @csrf
        
        <div class="mb-3">
          <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
          <input type="text" name="name" value="<?=(isset($_POST['name']))?$_POST['name']:''?>" class="form-control" id="name">
          <span class="text-danger"><?=(isset($validation))?display_error($validation, 'name'):''?></span>

        </div>
        <div class="mb-3">
          <label for="name" class="form-label">Email<span class="text-danger">*</span></label>
          <input type="text" name="email" value="<?=(isset($_POST['email']))?$_POST['email']:''?>" class="form-control" id="email">
          <span class="text-danger"><?=(isset($validation))?display_error($validation, 'email'):''?></span>
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Phone Number<span class="text-danger">*</span></label>
          <input type="text" name="phone" value="<?=(isset($_POST['phone']))?$_POST['phone']:''?>" class="form-control" id="phone">
          <span class="text-danger"><?=(isset($validation))?display_error($validation, 'phone'):''?></span>
        </div>
        <div class="mb-3">
          <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
          <textarea name="address" class="form-control" id="address" rows="3"><?=(isset($_POST['address']))?$_POST['address']:''?></textarea>
          <span class="text-danger"><?=(isset($validation))?display_error($validation, 'address'):''?></span>
        </div>
        <button type="submit" class="btn btn-success w-100">Place Order (COD)</button>
      </form>
    </div>
  </div>
</div>

@endsection