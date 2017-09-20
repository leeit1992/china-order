<div class="container">
	<div class="row">
		<div class="col-lg-12 atl-task-1" style="display: none;">
			<div class="jumbotron">
			  <h1>Hello, world!</h1>
			  <p>...</p>
			</div>
		</div>

		<div class="col-lg-6 atl-task-2" style="display: none;">
			<div class="panel panel-default">
			  	<div class="panel-heading">Check Method GET</div>
			  	<div class="panel-body">
				    <form method="GET">
						<div class="form-group">
						    <label for="exampleInputEmail1">Insert ID</label>
						    <input type="text" class="form-control atl-keyup" value="1" placeholder="Enter number id">
						</div>
						<a class="btn btn-default" id="form-get" data-url="<?php echo url('/') ?>" href="<?php echo url('/id/1') ?>" >Submit</a>
					</form>
				</div>
			</div>
		</div>

		<div class="col-lg-6 atl-task-3" style="display: none;">
			<div class="panel panel-default">
			  	<div class="panel-heading">Check Method POST</div>
			  	<div class="panel-body">
				    <form method="POST" action="<?php echo url('/validate') ?>">
						<div class="form-group">
						    <label for="exampleInputEmail1">Text</label>
						    <input type="text" class="form-control" name="text" placeholder="Enter text">
						</div>
						<button type="submit" class="btn btn-default">Submit</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col-lg-6 atl-task-4" style="display: none;">
			<div class="panel panel-default">
			  	<div class="panel-heading">Pagination</div>
			  	<div class="panel-body">
				    <?php echo $link; ?>
				</div>
			</div>
		</div>
	</div>
</div>

