<div class="w3-top">
    <div class="w3-bar w3-padding-large w3-row-padding" style="background-color: #337ab7; color: white">
        <h3 class="w3-half">
            <a href="../page/index.php" style="text-decoration: none; letter-spacing: 2px;">
                CITY HALL LOG BOOK SYSTEM
            </a>
        </h3>
        <?php if (isset($_SESSION['id']) && isset($displayLogout)): ?>
            <div class="w3-half" style="display:flex; justify-content: flex-end; align-items: center">
                <button type="button" id="logoutButton" class="btn btn-primary btn-lg">Logout</button>
            </div>
        <?php endif ?>
    </div>
</div>