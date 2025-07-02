<?php
require_once __DIR__ . '/../../config/session.php';
$total_pages = $_SESSION['total_pages'];
?>

<style>
    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin: 20px 0px;
    }

    .pagination button {
        padding: 8px 12px;
        border: 1px solid #ddd;
        background-color: white;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        color: #333;
        transition: background-color 0.2s;
    }

    .pagination button a {
        text-decoration: none;
        color: inherit;
    }

    .pagination button:hover {
        background-color: #e0e0e0;
    }

    .pagination button.active {
        background-color: rgba(141, 141, 141, 0.86);
        color: white;
        border-color: rgba(141, 141, 141, 0.86);
    }

    .pagination button:disabled {
        cursor: not-allowed;
        opacity: 0.5;
    }
</style>
<div class="pagination">
    <a href="/view/home.php?page=<?php echo $_GET['page'] - 1; ?>">
        <button <?php if ($_GET['page'] <= 1)
            echo 'disabled'; ?>>
            Previous
        </button>
    </a>
    <?php
    // Example pagination buttons
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<button class='page-button" . ($i === (int) $_GET['page'] ? " active" : "") . "'><a href='/view/home.php?page=$i'>$i</a></button>";
    }
    ?>
    <a href="/view/home.php?page=<?php echo $_GET['page'] + 1; ?>">
        <button <?php if ($_GET['page'] >= $total_pages)
            echo 'disabled'; ?>>
            Next
        </button>
    </a>
</div>