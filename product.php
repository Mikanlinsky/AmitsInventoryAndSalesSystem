<?php
  $page_title = 'All Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $products = join_product_table();

  // Sorting variables
  $sortTitle = isset($_GET['sort_title']) ? $_GET['sort_title'] : '';
  $sortCategory = isset($_GET['sort_category']) ? $_GET['sort_category'] : '';
  $sortDate = isset($_GET['sort_date']) ? $_GET['sort_date'] : '';

  // Sorting logic for product title
  if ($sortTitle === 'asc') {
    usort($products, function ($a, $b) {
      return strcmp($a['name'], $b['name']);
    });
  } elseif ($sortTitle === 'desc') {
    usort($products, function ($a, $b) {
      return strcmp($b['name'], $a['name']);
    });
  }

  // Sorting logic for category
  if ($sortCategory === 'asc') {
    usort($products, function ($a, $b) {
      return strcmp($a['categorie'], $b['categorie']);
    });
  } elseif ($sortCategory === 'desc') {
    usort($products, function ($a, $b) {
      return strcmp($b['categorie'], $a['categorie']);
    });
  }

  // Sorting logic for date added
  if ($sortDate === 'asc') {
    usort($products, function ($a, $b) {
      return strtotime($a['date']) - strtotime($b['date']);
    });
  } elseif ($sortDate === 'desc') {
    usort($products, function ($a, $b) {
      return strtotime($b['date']) - strtotime($a['date']);
    });
  }
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="add_product.php" class="btn btn-primary">Add New</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>
                  Product
                  <a href="?sort_title=<?php echo $sortTitle === 'asc' ? 'desc' : 'asc'; ?>" class="btn btn-default btn-xs" title="Sort by Name" data-toggle="tooltip">
                    <span class="glyphicon glyphicon-sort-by-alphabet"></span>
                  </a>
                </th>
                <th class="text-center" style="width: 10%;">
                  Categories
                  <a href="?sort_category=<?php echo $sortCategory === 'asc' ? 'desc' : 'asc'; ?>" class="btn btn-default btn-xs" title="Sort by Category" data-toggle="tooltip">
                    <span class="glyphicon glyphicon-sort-by-alphabet"></span>
                  </a>
                </th>
                <th class="text-center" style="width: 10%;">In-Stock</th>
                <th class="text-center" style="width: 10%;">
                  Date
                  <a href="?sort_date=<?php echo $sortDate === 'asc' ? 'desc' : 'asc'; ?>" class="btn btn-default btn-xs" title="Sort by Date Added" data-toggle="tooltip">
                    <span class="glyphicon glyphicon-sort-by-order"></span>
                  </a>
                </th>
                <th class="text-center" style="width: 100px;">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr>
                <td><?php echo remove_junk($product['name']); ?></td>
                <td class="text-center"><?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center"><?php echo remove_junk($product['quantity']); ?></td>
                <td class="text-center"><?php echo read_date($product['date']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php include_once('layouts/footer.php'); ?>
