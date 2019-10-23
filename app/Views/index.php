<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 21.10.2019
 * Time: 20:56
 *
 * @var $wallets array
 */
use App\Models\Wallet;

?>
<div class="container">
    <div class="row mb-4">
        <div class="col-10">
            <form action="/addWallet" method="POST">
                <div class="form-row align-items-center">
                    <div class="col-sm-8 my-1">
                        <label class="sr-only" for="wallet_address">Адрес кашелька</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fal fa-dove"></i></div>
                            </div>
                            <input
                                    name="Wallet[address]"
                                    type="text"
                                    class="form-control"
                                    id="wallet_address"
                                    placeholder="Введите адрес кошелька"
                                    required
                                    minlength="40"
                                    maxlength="46"
                            >
                        </div>
                    </div>
                    <div class="col-auto my-1">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<section class="wallet-list">

    <div class="container">
      <div class="row">
          <div class="col-12">
              <table class="table table-striped">
                  <caption>Добавленные кошельки</caption>
                  <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Адресс</th>
                      <th scope="col">Баланс</th>
                      <th scope="col">Дата добавления</th>
                      <th scope="col"></th>
                  </tr>
                  <?php foreach ($wallets as $wallet) :?>
                      <tr scope="row">
                          <td><?= $wallet['id']?></td>
                          <td><?= $wallet['address']?></td>
                          <td>
                              <?php
                              $balance = Wallet::getBalance($wallet['address']);
                              if (is_null($balance))
                                  echo 'Указан неверный адрес';
                              else
                                  echo $balance . ' ETH'
                              ?>
                          </td>
                          <td><?= date('d.m.Y h:i', strtotime($wallet['created']))?></td>
                          <td><a href="/removeWallet?id=<?= $wallet['id']?>" type="button" class="btn btn-danger">Удалить</a></td>
                      </tr>
                  <?php endforeach; ?>
              </table>
          </div>
      </div>
    </div>


</section>

