<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 col-md-offset-5">
            <div id="cart-header">Корзина</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-md-offset-2">
            <img src="<?=base_url()?>public/img/item.png" width="128px" alt="Item picture">
        </div>
        <div class="col-md-6">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-md-offset-10">
            <form>
                <table>
                    <tr>
                        <td>
                            <span>Стоимость</span>
                        </td>
                        <td>
                            <input name="amount" value="100" id="price-amount">
                        </td>
                        <td>
                            <input name="currency" value="USD" readonly id="price-currency">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Имя</span>
                        </td>
                        <td colspan="2">
                            <input name="name">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>ID (CPF)</span>
                        </td>
                        <td colspan="2">
                            <input name="cpf">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Email</span>
                        </td>
                        <td colspan="2">
                            <input name="email">
                        </td>
                    </tr>
                </table>
                <?= isset($error) ? "<div class='error'>{$error}</div>" : null ;?>
                <button formmethod="post" formaction="/payment"><img src="<?=base_url()?>public/img/item.png" width="24px" alt="" class="button-image">Оформить</button>
            </form>
        </div>
    </div>
</div>