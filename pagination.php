<div class="my-3">
    <nav aria-label="Page navigation example" class="mx-auto new-pagination">
    <ul class="pagination">
        <?php if($halamanAktif != 1) : ?>
        <li class="page-item">
        <a class="page-link" href="?page<?=$j - 1?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
        </li>
        <?php endif ; ?>
              
        <?php for($j=1; $j <= $jumlahHalaman; $j++) : ?>
              
        <?php if($j == $halamanAktif) : ?>
                  <li class="page-item"><a class="page-link" href="?page=<?=$j?>"><?=$j?></a></li>
        <?php else : ?>
                  <li class="page-item"><a class="page-link text-dark" href="?page=<?=$j?>"><?=$j?></a></li>
        <?php endif ; ?>

        <?php endfor ; ?>

        <?php if($halamanAktif != 1) : ?>
        <li class="page-item">
        <a class="page-link" href="?page<?=$j + 1?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
        </a>
        </li>
        <?php endif ; ?>
    </ul>
    </nav>
</div>