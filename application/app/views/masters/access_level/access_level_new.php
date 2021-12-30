<div class="main-content">
	<div class="page-content">
		<div class="container-fluid">
			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box d-flex align-items-center justify-content-between">
						<h4 class="mb-0 font-size-18"><?php if(isset($access_level)){ echo "UPDATE"; }else{ echo "NEW"; } ?> ACCESS LEVEL</h4>
						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="javascript: void(0);">Access Level</a></li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 message"><?php message(); ?></div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<form method="post" id="access_level_form">
								<!-- GENERAL DETAILS -->
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label>ACCESS NAME</label>
											<input type="text" id="access_level_name" name="access_level_name" class="form-control" placeholder="Enter Name" value="<?php if(isset($access_level)){ echo $access_level['access_level_name']; } ?>">
										</div>  
									</div>
								</div>
								<div class="col-xl-12">
									<div class="accordion" id="accordionExample">
										<div class="card">
											<div class="card-header" id="headingOne">
												<h2 class="mb-0">
													<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
														MODULE ACCESS
													</button>
												</h2>
											</div>
											<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
												<div class="card-body">
													<ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
														<?php $menus = module_list();
														if($menus){
															foreach ($menus as $key => $menu) {
																$active = ($key==0) ? 'active' : '' ;
																echo '<li class="nav-item">
																<a class="nav-link '.$active.'" id="pills-home-tab" data-toggle="pill" 
																href="#pills-sales'.$key.'" role="tab" aria-controls="pills-home" aria-selected="true">'.$menu['module_name'].'</a>
																</li>'; 
															}
														} ?>
													</ul>
													<div class="tab-content" id="pills-tabContent">
														<?php
														if($menus){
															$count = 0;
															foreach ($menus as $key => $menu) { 
																?>
																<div class="tab-pane fade show <?php if($key == 0){ echo "active";} ?>" id="pills-sales<?php echo $key; ?>" role="tabpanel" aria-labelledby="pills-home-tab">
																	<div class="row"><h6><strong>MODULE</strong></h6></div>
																	<div class="row">
																		<div class="col-12 p-3">
																			<!-- Default checked -->
																			<div class="custom-control custom-switch module">
																				<input type="checkbox" class="custom-control-input module_check  module_<?php echo strtolower($menu['module_name']); ?>" id="customSwitchlg<?php echo $key; ?>" data-module="sub_module_<?php echo strtolower($menu['module_name']); ?>" value="<?php echo $menu['module_id']; ?>" name="modules[]" <?php if(isset($access_level)){ if(in_array($menu['module_id'], explode(',',$access_level['modules'])) ){ echo "checked"; } } ?> >
																				<label class="custom-control-label" for="customSwitchlg<?php echo $key; ?>"><?php echo strtoupper($menu['module_name']); ?></label>
																			</div>
																		</div>
																	</div>
																	<?php if($menu['submenus']){ ?>
																		<div class="row"><h6><strong><?php echo $menu['module_name']; ?> - MODULE</strong></h6></div>
																		<div class="row p-3">
																			<?php
																			foreach ($menu['submenus'] as $key => $submenu) { ?>
																				<div class="square-switch col-2">
																					<div class="row p-3"><h6><?php echo strtoupper($submenu['sub_module_name']); ?></h6></div>
																					<input type="checkbox" id="square-switch<?php echo next_number($count); ?>" value="<?php echo $submenu['sub_module_id']; ?>" name="submodules[]" 
																					<?php if($submenu['sub_module_id'] && $submenu['status'] == 1){ echo "checked"; } ?> switch="bool">
																					<label for="square-switch<?php echo next_number($count); ?>" data-on-label="Yes"
																						data-off-label="No" value = <?php echo $submenu['sub_module_id']; ?>></label>
																					</div>
																					<?php $count = next_number($count); }  ?>
																				</div>
																			<?php } ?>
																		</div>
																	<?php } } ?>
																</div>
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="card-body">
													<div class="row">
														<div class="col-md-6">
															<a href="<?php echo base_url('access_levels'); ?>" class="btn btn-dark">CANCEL</a>
														</div>
														<div class="col-md-6">
															<button type="submit" class="btn btn-success pull-right" style="text-align:right;"> <i class="fa fa-check"></i> <?php if(isset($access_level)){ echo 'UPDATE'; }else{ echo "CREATE"; } ?></button>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>