<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 21.10.2019
 * Time: 20:56
 *
 * @var $transactions array
 */
?>
<section class="wallet-list">

    <div class="container">
      <div class="row">
          <div class="col-12">
              <table class="table table-striped">
                  <caption>Транзакции</caption>
                  <tr>
                      <th scope="col">Адресс</th>
                      <th scope="col">ID транзакции</th>
                      <th scope="col">Кол-во подтверждений</th>
                  </tr>
                  <?php foreach ($transactions as $transaction) :?>
                      <tr scope="row">
                          <td><?= $transaction['address']?></td>
                          <td><?= $transaction['id']?></td>
                          <td><?= $transaction['count']?></td>
                      </tr>
                  <?php endforeach; ?>
              </table>
          </div>
      </div>
    </div>


</section>

