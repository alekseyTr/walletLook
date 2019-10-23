<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 21.10.2019
 * Time: 20:56
 *
 * @var $transactions array
 * @var $wallet array
 */
?>
<section class="wallet-list">
    <div class="container">
      <div class="row">

          <?php if ($wallet) :?>
              <div class="col-12 pb-4">
                  <h5>Адрес: <?= $wallet['address'] ?></h5>
              </div>
          <?php endif; ?>

          <div class="col-12">
              <table class="table table-striped transaction-table" <?= $wallet['address'] ? 'data-wallet-address="'.$wallet['address'].'"' : null ?>>
                  <caption>Транзакции</caption>
                  <tr>
                      <th scope="col">Адресс</th>
                      <th scope="col">ID транзакции</th>
                      <th scope="col">Кол-во подтверждений</th>
                  </tr>
                  <tbody>
                    <!-- Dynamic data -->
                  </tbody>
              </table>
          </div>
      </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        //const Web3 = require("web3");
        let web3 = new Web3(
            new Web3.providers.WebsocketProvider("wss://mainnet.infura.io/ws/v3/12b11dc823d1436996faa220a650623b")
        );
        // Prepare params
        var params = {},
            $walletAddress = $('.transaction-table').data('wallet-address');
        if ($walletAddress !== undefined)
            params.address = $walletAddress;
        // Create subscription
        var logSubscription = web3.eth.subscribe('logs', params, function (error, result) {
            })
                .on("data", function (log) {
                    // Get transaction data and add to common list
                    web3.eth.getTransaction(log['transactionHash'])
                        .then(function (transaction) {
                            if (transaction !== null)
                                addTransactionNode(transaction)
                        })
                })
                .on("changed", function (log) {

                })
        ;

        /*subscription.unsubscribe(function(error, success){
            if(success)
                console.log('Successfully unsubscribed!');
        });*/

        function addTransactionNode(transaction) {
            console.log(transaction);
            $('.transaction-table > tbody:last-child').prepend(
                '<tr scope="row">' +
                    '<td>'+ transaction['from'] +'</td>' +
                    '<td>'+ transaction['blockHash'] +'</td>' +
                    '<td>'+ transaction['nonce'] +'</td>' +
                '</tr>'
            );
        }
    });

</script>

