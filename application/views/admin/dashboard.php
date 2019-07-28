<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php  $this->load->view('admin/_partials/header.php');?>

<body>
	<!-- Sidenav PHP-->
	<?php $this->load->view('admin/_partials/sidenav.php');?>
	<!-- Main content -->
	<div class="main-content" id="panel">
		<!-- Topnav PHP-->
		<?php $this->load->view('admin/_partials/topnav.php');
         ?>
		<!-- Header -->
		<!-- BreadCrumb PHP -->
		<?php $this->load->view('admin/_partials/breadcrumb.php');
         ?>
		<!-- Page content -->
		<div class="container-fluid mt--6">
			<!-- Table -->
			<div class="row">
				<div class="col">
					<div class="card">
						<!-- Card header -->
						<div class="card-header">
							<h3 class="mb-0">Action buttons</h3>
							<p class="text-sm mb-0">
								This is an exmaple of datatable using the well known datatables.net plugin. This is a
								minimal setup in order to get started fast.
							</p>
						</div>
						<div class="table-responsive py-4">
							<table class="table table-flush" id="datatable-buttons">
								<thead class="thead-light">
									<tr role="row">
										<th>Name</th>
										<th>Position</th>
										<th>Office</th>
										<th>Age</th>
										<th>Start date</th>
										<th>Salary</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>Name</th>
										<th>Position</th>
										<th>Office</th>
										<th>Age</th>
										<th>Start date</th>
										<th>Salary</th>
									</tr>
								</tfoot>
								<tbody>
									<tr role="row" class="odd">
										<td class="sorting_1">Airi Satou</td>
										<td>Accountant</td>
										<td>Tokyo</td>
										<td>33</td>
										<td>2008/11/28</td>
										<td>$162,700</td>
									</tr>
									<tr role="row" class="even">
										<td class="sorting_1">Angelica Ramos</td>
										<td>Chief Executive Officer (CEO)</td>
										<td>London</td>
										<td>47</td>
										<td>2009/10/09</td>
										<td>$1,200,000</td>
									</tr>
									<tr role="row" class="odd">
										<td class="sorting_1">Ashton Cox</td>
										<td>Junior Technical Author</td>
										<td>San Francisco</td>
										<td>66</td>
										<td>2009/01/12</td>
										<td>$86,000</td>
									</tr>
									<tr role="row" class="even">
										<td class="sorting_1">Bradley Greer</td>
										<td>Software Engineer</td>
										<td>London</td>
										<td>41</td>
										<td>2012/10/13</td>
										<td>$132,000</td>
									</tr>
									<tr role="row" class="odd">
										<td class="sorting_1">Brenden Wagner</td>
										<td>Software Engineer</td>
										<td>San Francisco</td>
										<td>28</td>
										<td>2011/06/07</td>
										<td>$206,850</td>
									</tr>
									<tr role="row" class="even">
										<td class="sorting_1">Brielle Williamson</td>
										<td>Integration Specialist</td>
										<td>New York</td>
										<td>61</td>
										<td>2012/12/02</td>
										<td>$372,000</td>
									</tr>
									<tr role="row" class="odd">
										<td class="sorting_1">Bruno Nash</td>
										<td>Software Engineer</td>
										<td>London</td>
										<td>38</td>
										<td>2011/05/03</td>
										<td>$163,500</td>
									</tr>
									<tr role="row" class="even">
										<td class="sorting_1">Caesar Vance</td>
										<td>Pre-Sales Support</td>
										<td>New York</td>
										<td>21</td>
										<td>2011/12/12</td>
										<td>$106,450</td>
									</tr>
									<tr role="row" class="odd">
										<td class="sorting_1">Airi Satou</td>
										<td>Accountant</td>
										<td>Tokyo</td>
										<td>33</td>
										<td>2008/11/28</td>
										<td>$162,700</td>
									</tr>
									<tr role="row" class="even">
										<td class="sorting_1">Angelica Ramos</td>
										<td>Chief Executive Officer (CEO)</td>
										<td>London</td>
										<td>47</td>
										<td>2009/10/09</td>
										<td>$1,200,000</td>
									</tr>
									<tr role="row" class="odd">
										<td class="sorting_1">Ashton Cox</td>
										<td>Junior Technical Author</td>
										<td>San Francisco</td>
										<td>66</td>
										<td>2009/01/12</td>
										<td>$86,000</td>
									</tr>
									<tr role="row" class="even">
										<td class="sorting_1">Bradley Greer</td>
										<td>Software Engineer</td>
										<td>London</td>
										<td>41</td>
										<td>2012/10/13</td>
										<td>$132,000</td>
									</tr>
									<tr role="row" class="odd">
										<td class="sorting_1">Brenden Wagner</td>
										<td>Software Engineer</td>
										<td>San Francisco</td>
										<td>28</td>
										<td>2011/06/07</td>
										<td>$206,850</td>
									</tr>
									<tr role="row" class="even">
										<td class="sorting_1">Brielle Williamson</td>
										<td>Integration Specialist</td>
										<td>New York</td>
										<td>61</td>
										<td>2012/12/02</td>
										<td>$372,000</td>
									</tr>
									<tr role="row" class="odd">
										<td class="sorting_1">Bruno Nash</td>
										<td>Software Engineer</td>
										<td>London</td>
										<td>38</td>
										<td>2011/05/03</td>
										<td>$163,500</td>
									</tr>
									<tr role="row" class="even">
										<td class="sorting_1">Caesar Vance</td>
										<td>Pre-Sales Support</td>
										<td>New York</td>
										<td>21</td>
										<td>2011/12/12</td>
										<td>$106,450</td>
									</tr>
									<tr role="row" class="odd">
										<td class="sorting_1">Cara Stevens</td>
										<td>Sales Assistant</td>
										<td>New York</td>
										<td>46</td>
										<td>2011/12/06</td>
										<td>$145,600</td>
									</tr>
									<tr role="row" class="even">
										<td class="sorting_1">Cedric Kelly</td>
										<td>Senior Javascript Developer</td>
										<td>Edinburgh</td>
										<td>22</td>
										<td>2012/03/29</td>
										<td>$433,060</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- Footer PHP -->
			<?php $this->load->view('admin/_partials/footer.php');?>
		</div>

	</div>
	<!-- Scripts PHP-->
	<?php $this->load->view('admin/_partials/js.php');
    ?>
	<!-- Demo JS - remove this in your project -->
	<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
