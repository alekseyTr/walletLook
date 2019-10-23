<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 21.10.2019
 * Time: 20:54
 *
 * @var $this \App\Controllers\Controller;
 *
 */
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title><?= $this->getTitle()?></title>

    <style>
        h1 {
            margin: 3rem 1rem;
        }
        header .navbar {
            border-radius: 6px;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }
        .navbar-nav .active {
            border-bottom: 1px solid;
        }
        .transaction-table td,
        .table .overflow {
            max-width: 300px;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

    </style>
</head>
<body>

<header>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1><?= $this->getTitle();?></h1>
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link <?= $this->action == 'index' ? 'active' : null?>" href="/">Кошельки</a>
                        <a class="nav-item nav-link <?= $this->action == 'allTransactions' ? 'active' : null?>" href="/allTransactions">Все транзакции сети</a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>


<div class="app"><?= $content ?></div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js@1.0.0-beta.36/dist/web3.min.js" crossorigin="anonymous"></script>
</body>
</html>
