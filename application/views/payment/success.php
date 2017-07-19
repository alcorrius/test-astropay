<div class="container-fluid">
    <div class="row">
        <span>Заказ №:</span>
        <span><?= isset($order_id) ? $order_id : null?></span>
        <?= isset($message) ? $message : null?>
    </div>
    <div class="row">
        <form >
        <input value="<?= isset($order_id) ? $order_id : null?>" name="order_id">
            <button formmethod="post" formaction="/payment/status">Проверить статус</button>
        </form>
    </div>
</div>
