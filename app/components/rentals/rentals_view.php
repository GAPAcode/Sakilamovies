<?php $rentals->get_navbar() ?>

<div class="container">
    <?php if( count( $rentals->userRentals ) > 0 ): ?>
    <div class="card w-75 mx-auto mt-5">
        <div class="card-header">
            <h3>Your rentals</h3>
            <?php if(isset($_POST['msg']))
                echo '<strong>'.$_POST['msg'].'</strong>';
            ?>
        </div>

        <div class="card-body">
            <div class="row">
            <?php foreach($rentals->userRentals as $rental):?>
                <div class="col-md-6 py-1">

                    <div class="card">
                        <div class="card-header bg-dark text-light">
                            <strong><?php echo $rental['title'] ?></strong>
                        </div>
                        <div class="card-body">
                            <p> <strong>Rental ID: </strong> <?php echo $rental['rental_id'] ?></p>
                            <p> <strong>Rental Date: </strong> <?php echo $rental['rental_date'] ?></p>
                        </div>
                        <div class="card-footer">
                            <a href="/sakila/rentals/return/<?php echo $rental['rental_id'] ?>"
                               class="btn btn-primary w-100" >
                                Return This Film   
                            </a>
                        </div>
                    </div>

                </div>
            <?php endforeach ?>
            </div>
        </div>
    </div>

    <?php else: ?>
        <div class="card w-50 mx-auto mt-5">
                <div class="card-header">
                    <h3 class="text-center">You dont have Rentals</h3>
                </div> 

                <div class="card-body">
                    <div class="text-center">
                        <i class="fa fa-film fa-5x"></i>
                    </div>

                    <div class="text-center font-weight-bold mt-3">
                        <p>Rent some movies!</p>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="index" class="btn btn-success w-100 font-weight-bold"> 
                        Back to Film Index
                    </a>
                </div>
            </div>
    <?php endif ?>
</div>

<?php 
    $rentals->getFooter();
?>