<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 21.10.2019
 * Time: 20:56
 */

?>


<div class="container">
    <div class="row">

        <div class="col-12">

            <form action="/addWallet">
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

