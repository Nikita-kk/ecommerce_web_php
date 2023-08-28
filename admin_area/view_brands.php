<h3 class="text-center text-success">All Brands</h3>
<table class="table table-bordered mt-5">
  <thead class="bg-info">
    <tr class="text-center">
      <th>Sl no</th>
      <th>Brands Title</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody class="bg-secondary text-light">

    <?php
    $select_brands = "SELECT * FROM `brands`";
    $result = mysqli_query($conn, $select_brands);
    $number = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $brands_id = $row['brands_id'];
        $brands_title = $row['brands_title'];
        $number++;
    ?>

    <tr class="text-center">
      <td><?php echo $number ?></td>
      <td><?php echo $brands_title ?></td>
      <td><a href='index.php?edit_brands=<?php echo $brands_id ?>' class='text-light'><i class='fa-regular fa-pen-to-square'></i></a></td>
      <td><a href='index.php?delete_brands=<?php echo $brands_id ?>' type="button" class="text-light" data-toggle="modal" data-target="#exampleModal-<?php echo $brands_id ?>"><i class='fa-sharp fa-solid fa-trash'></i></a></td>
    </tr>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal-<?php echo $brands_id ?>" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <h4>Are you sure you want to delete this?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <a href="index.php?delete_brands=<?php echo $brands_id ?>" class="btn btn-primary text-light text-decoration-none">Yes</a>
          </div>
        </div>
      </div>
    </div>

    <?php } ?>
  </tbody>
</table>
