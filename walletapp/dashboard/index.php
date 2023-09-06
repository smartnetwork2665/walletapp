<?php 
session_start();
if(!isset($_SESSION['email'])){
    header('location: ../index.php');
    exit();
}

include "classes/Account.php";
$account = new Account();
$user_id = $_SESSION['id'];
$user = $account->getUserByUserId($user_id);
$user_funding_total = $account->userFundingsSum($user_id);
include "config/db_connect.php";
include "includes/header.php";
?>
 <div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
   
    <p class="lead"><strong>Hello!</strong><?php if(isset($_SESSION['email'])){ echo ' '. $_SESSION['email']; }?></p>
    
    <ol class="breadcrumb mb-4">
    
        <div class="ms-auto">
            <a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">Fund Wallet</a>
            <a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">Withdraw From Wallet</a>
        </div>
    </ol>
    <div class="row g-3">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4 w-100 h-100">
                <div class="card-header">
                    <h4 class="text-center">Balance</h4>
                </div>  
                <div class="card-body">
                    <p class="h4 text-center"><?php echo $user['balance']; ?></p>
                </div> 
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4 w-100 h-100">
                    <div class="card-header">
                        <h4 class="text-center">Total Transaction</h4>
                    </div>
                    <div class="card-body">
                        <p class="small">fundings in numbers here</p>
                        <p class="small">withdrawals in numbers here</p>
                    </div>   
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4 w-100 h-100">
                <div class="card-header">
                    <h4 class="text-center">Total Withdrawals</h4>
                </div>
                <div class="card-body">
                    <p class="lead text-center">Amount here</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-secondary text-white mb-4 w-100 h-100 ">
                <div class="card-header">
                    <h4 class="text-center">Total Fundings</h4>
                </div>
                <div class="card-body">
                    <p class="lead text-center"><?php echo $user_funding_total['amount'] ; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include "transhistory/withdrawal_hist.php";
include "transhistory/fundings_hist.php";
include "modals/fundform.php";
include "modals/withdrawalform.php";
include "includes/footer.php";
include "includes/scripts.php";
?>