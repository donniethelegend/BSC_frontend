

    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
              <?php if ($_SESSION[base64_encode("role")] == base64_encode('administrator') ){ 
              
                  ?>
          
            
          <li class="nav-item">
            <a class="nav-link <?php   echo $_getParam['form']=='dashboard'?"active":''; ?>" href="./?<?php echo base64_encode("form=dashboard"); ?> ">
              <span data-feather="bar-chart"></span>
              Dashboard
            </a>
          </li>
              <?php } 
              
              if ($_SESSION[base64_encode("role")] == base64_encode('administrator')||$_SESSION[base64_encode("role")] == base64_encode('moderator') ){ ?>
          
        
          
             
          
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" role="button" data-bs-target="#details_nav" aria-expanded="<?php   echo $_getParam['form']=='province_mgmt'?"true":'false'; ?>" aria-controls="details_nav" >
              <span data-feather="info"></span>
              Details
            </a>
            <!--What ever the parameter form inside will be the parent-->
              
              <div class="collapse <?php   echo $_getParam['form']=='province_mgmt'||
                      $_getParam['form']=='category_mgmt'||
                      $_getParam['form']=='outcome_mgmt'||
                      $_getParam['form']=='objective_mgmt'||
                      $_getParam['form']=='indicator_mgmt'?"show":''; ?>" id="details_nav">
                    
                       <ul class="nav flex-column">
                              
                               <li class="nav-item">
                                    <a class="nav-link <?php   echo $_getParam['form']=='category_mgmt'?"active":''; ?>" href="./?<?php echo base64_encode("form=category_mgmt"); ?>">
                                     &nbsp; <span data-feather="filter"></span>
                                      Category
                                    </a>
                                  </li>
                                 
                               <li class="nav-item">
                                    <a class="nav-link <?php   echo $_getParam['form']=='outcome_mgmt'?"active":''; ?>" href="./?<?php echo base64_encode("form=outcome_mgmt"); ?>">
                                     &nbsp; <span data-feather="droplet"></span>
                                      Outcome
                                    </a>
                                  </li>
                                   <li class="nav-item">
                                    <a class="nav-link <?php   echo $_getParam['form']=='objective_mgmt'?"active":''; ?>" href="./?<?php echo base64_encode("form=objective_mgmt"); ?>">
                                     &nbsp; <span data-feather="package"></span>
                                      Objective
                                    </a>
                                  </li>
                              
                                    <li class="nav-item">
                                <a class="nav-link <?php   echo $_getParam['form']=='indicator_mgmt'?"active":''; ?>" href="./?<?php echo base64_encode("form=indicator_mgmt"); ?>">
                                    &nbsp;  <span data-feather="flag"></span>
                                  Indicator/s
                                </a>
                      </li>
                       <li class="nav-item">
                                    <a class="nav-link <?php   echo $_getParam['form']=='province_mgmt'?"active":''; ?>" href="./?<?php echo base64_encode("form=province_mgmt"); ?>">
                                     &nbsp; <span data-feather="map-pin"></span>
                                      Province
                                    </a>
                                  </li>
                       </ul>
                 
                 </div>
              
              
          </li>
      
          
           <?php } 
           
           if ($_SESSION[base64_encode("role")] == base64_encode('administrator') ){ ?>
          
          <li class="nav-item">
            <a class="nav-link <?php   echo $_getParam['form']=='user_mgmt'?"active":''; ?>" href="./?<?php echo base64_encode("form=user_mgmt"); ?>">
              <span data-feather="users"></span>
              Users
            </a>
          </li>
          
          <?php } ?>
          
           <li class="nav-item">
            <a class="nav-link <?php   echo $_getParam['form']=='deadline'?"active":''; ?>" href="./?<?php echo base64_encode("form=deadline"); ?>" >
              <span data-feather="calendar"></span>
              Deadlines
             
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php   echo $_getParam['form']=='target_mgmt'?"active":''; ?>" href="./?<?php echo base64_encode("form=target_mgmt"); ?>">
              <span data-feather="target"></span>
              Target/Commitment
            </a>
          </li>
         
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>
        </ul>
          
      
      </div>
    </nav>
      
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">