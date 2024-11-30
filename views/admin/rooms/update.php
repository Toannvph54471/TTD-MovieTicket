<?php
if (isset($_SESSION['success'])) {
    $class = $_SESSION['success'] ? 'alert-success' : 'alert-danger';

    echo "<div class='alert $class'>{$_SESSION['msg']}</div>";

    unset($_SESSION['success']);
    unset($_SESSION['msg']);
}
?>

<?php if (!empty($_SESSION['errors'])): ?>

    <div class="alert alert-danger">
        <ul>
            <?php foreach ($_SESSION['errors'] as $value): ?>
                <li><?= $value ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php
    unset($_SESSION['errors']);
endif;
?>

<form action="<?= BASE_URL_ADMIN . '&action=rooms-update&id=' . $room['id'] ?>" method="POST" enctype="multipart/form-data">
    <div class="my-3">
        <label for="name" class="form-label">Tên phòng:</label>
        <input type="text" class="form-control" name="name" id="name"
            value="<?php if (isset($_SESSION['data'])) {
                        echo $_SESSION['data']['name'];
                    } else {
                        echo $room['name'];
                    } ?>">
    </div>
    <div class="my-3">
        <label for="type" class="form-label">Loại phòng:</label>
        <select class="form-select" name="type" id="type">
            <option value="">Lựa chọn loại phòng</option>
            <option value="IMAX" <?php if (isset($room['type']) && $room['type'] === 'IMAX') echo 'selected' ?>>IMAX</option>
            <option value="3D" <?php if (isset($room['type']) && $room['type'] === '3D') echo 'selected' ?>>3D</option>
            <option value="2D" <?php if (isset($room['type']) && $room['type'] === '2D') echo 'selected' ?>>2D</option>
        </select>
    </div>
    <div class="my-3">
        <label for="description" class="form-label">Mô tả:</label>
        <textarea name="description" id="description" class="form-control"><?php if (isset($_SESSION['data'])) {
                                                                                echo $_SESSION['data']['description'];
                                                                            } else {
                                                                                echo $room['description'];
                                                                            } ?></textarea>
    </div>

    <div class="my-3">
        <label for="status" class="form-label">Trạng thái:</label>
        <select class="form-select" name="status">
            <option value="">Lựa chọn trạng thái</option>
            <option value="Active" <?php if (isset($room['status']) && $room['status'] === 'Active') echo 'selected' ?>>Active</option>
            <option value="Deactive" <?php if (isset($room['status']) && $room['status'] === 'Deactive') echo 'selected' ?>>Deactive</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="<?= BASE_URL_ADMIN . '&action=rooms-list' ?>" class="btn btn-danger">Quay lại danh sách</a>
</form>