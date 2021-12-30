	<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
		<div class="card-body">
			<ul class="nav nav-tabs nav-tabs-custom nav-justified mb-3" id="pills-tab" role="tablist">
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
								<div class="row"><h6><strong>SUB MODULE</strong></h6></div>
								<div class="row p-3">
									<?php
									foreach ($menu['submenus'] as $key => $submenu) { ?>
										<div class="square-switch col-2">
											<div class="row p-3"><h6><?php echo strtoupper($submenu['sub_module_name']); ?></h6></div>
											<input type="checkbox" id="square-switch<?php echo next_number($count); ?>" value="<?php echo $submenu['sub_module_id']; ?>" name="submodules[]" 
											<?php if(isset($access_level)){ if(in_array($submenu['sub_module_id'], explode(',',$access_level['submodules'])) ){ echo "checked"; } } ?> switch="bool">
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