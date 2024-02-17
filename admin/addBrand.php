<?php include_once 'includes/head.php'; ?>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Brand</h3>
            </div>
            <form action="brandsCode.php" method="POST" class="forms-sample">
                <div class="card-body">
                    <div class="form-group">
                        <label for="brandName">Username</label>
                        <input type="text" name="brandName" id="brandName" class="form-control" placeholder="Input brand name">
                    </div>
                </div>
                <div class="card-footer">
                <input type="hidden" name="page" value="brands">
                <input type="hidden" name="action" value="addBrand">
                <input type="submit" class="btn btn-inverse-info me-2 form-control" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once 'includes/foot.php'; ?>