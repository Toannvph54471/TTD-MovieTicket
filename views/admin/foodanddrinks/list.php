<a href="<?= BASE_URL_ADMIN . '&action=foodanddrinks-create' ?>" class="w-25 btn btn-primary mb-3">Thêm mới</a>

<?php

if (isset($_SESSION['success'])) {
    $class = $_SESSION['success'] ? 'alert-success' : 'alert-danger';

    echo "<div class='alert $class'>{$_SESSION['msg']}</div>";

    unset($_SESSION['success']);
    unset($_SESSION['msg']);
}
?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Phân loại</th>
            <th>Mô tả</th>
            <th>Giá tiền</th>
            <th>Số lượng tồn kho</th>
            <th>Ảnh minh họa</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt = 1;
        foreach ($data as $foodAndDrink) : ?>
            <td><?= $stt++ ?></td>
            <td><?= $foodAndDrink['name'] ?></td>
            <td><?= $foodAndDrink['type'] ?></td>
            <td><?php
                $maxLength = 50;
                $shortenData = mb_substr($foodAndDrink['description'], 0, $maxLength, 'UTF-8');
                echo $shortenData . ' ...';
                ?></td>
            <td><?= $foodAndDrink['price'] ?></td>
            <td><?= $foodAndDrink['quantity'] ?></td>
            <td>
                <?php if (!empty($foodAndDrink['imageURL'])) : ?>
                    <img src="<?= BASE_ASSETS_UPLOADS . $foodAndDrink['imageURL'] ?>" width="100px">
                <?php endif; ?>
            </td>
            <td class="d-flex justify-content-center">
                <a href="<?= BASE_URL_ADMIN . '&action=foodanddrinks-show&id=' . $foodAndDrink['id'] ?>"
                    class="btn btn-info">Xem</a>
                <a href="<?= BASE_URL_ADMIN . '&action=foodanddrinks-updatePage&id=' . $foodAndDrink['id'] ?>"
                    class="btn btn-warning mx-2">Sửa</a>
                <a href="<?= BASE_URL_ADMIN . '&action=foodanddrinks-delete&id=' . $foodAndDrink['id'] ?>"
                    onclick="return confirm('Bạn có chắc muốn xóa?')"
                    class="btn btn-danger">Xóa</a>
            </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>