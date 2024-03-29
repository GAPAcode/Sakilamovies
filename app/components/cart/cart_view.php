<?php
    $this->get_header();
    $this->get_navbar();
?>

<div class="container" id="cart-container">
    <?php if( $this->isCartEmpty() ): ?>

        <div class="card w-50 mx-auto my-5">
            <div class="card-header">
                <h3 class="text-center">The cart is empty!</h3>
            </div> 

            <div class="card-body">
                <div class="text-center">
                    <i class="fa fa-shopping-cart fa-5x"></i>
                </div>

                <div class="text-center font-weight-bold mt-3">
                    <p>Add some movies and come back to rent him!</p>
                </div>
            </div>

            <div class="card-footer">
                <a href="index" class="btn btn-success w-100 font-weight-bold"> 
                    Back to Film Index
                </a>
            </div>
        </div>

    <?php else: ?>

        <div class="card w-75 mx-auto mt-2">
            <div class="card-header">
                <h2>Your film Cart</h2>
            </div>

            <div class="card-body">

                <table class="table">
                    <thead class="thead-dark">
                        <th>Film Id</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php
                            $totalPayment = 0; 
                            foreach( $this->cartItems as $cartItem ):
                        ?>
                        <tr id="<?php echo 'item-' . $cartItem['filmId'] ?>">
                            <td> <?php echo $cartItem['filmId'] ?> </td>
                            <td> <?php echo $cartItem['title'] ?> </td>
                            <td class="item-price"> <?php echo $cartItem['price'] ?> </td>
                            <td> 
                                <a href="#" class="cart-delete" 
                                    data-item=" <?php echo $cartItem['filmId'] ?> ">
                                    &times;
                                </a> 
                            </td>
                        </tr>
                        <?php
                            $totalPayment += floatval($cartItem['price']);
                            endforeach; 
                        ?>
                        <tr>
                            <td colspan="2" class="text-right">
                                <strong>Total:</strong>
                            </td>
                            <td colspan="2" class="font-weight-bold" id="cart-total">
                                $<?php echo $totalPayment; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <div class="card-footer text-center">
                <a class="btn btn-success w-50" href="/sakila/cart/checkout/">
                    Rent Movies Now!
                </a>
            </div>
        </div>
        
    <?php endif; ?>
</div>

<?php 
    $this->getFooter();
?>
