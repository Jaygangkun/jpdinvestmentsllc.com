<!-- Main content -->
<?php
if(!isset($application) || $application == null) {
  ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6">
          <div class="card card-primary">
            <div class="card-body">
              <h5 class="text-danger">Not Found Application Data</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php  
  die();
}
?>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <form id="form_application">
          <div class="card card-primary">
            <div class="card-body">
              <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                  <option value="" <?php echo $application->status == '' ? 'selected' : ''?>>Select Status</option>
                  <option value="Interview" <?php echo $application->status == 'Interview' ? 'selected' : ''?>>Interview</option>
                  <option value="Rejected" <?php echo $application->status == 'Rejected' ? 'selected' : ''?>>Rejected</option>
                  <option value="Defer" <?php echo $application->status == 'Defer' ? 'selected' : ''?>>Defer</option>
                  <option value="Interview Completed" <?php echo $application->status == 'Interview Completed' ? 'selected' : ''?>>Interview Completed</option>
                  <option value="Hired" <?php echo $application->status == 'Hired' ? 'selected' : ''?>>Hired</option>
                </select>
              </div>
              <div class="form-group">
                <label>Which location are you applying for:</label>
                <select class="form-control" name="location_apply_for">
                  <option value="1" <?php echo $application->location_apply_for == '1' ? 'selected' : ''?>>Salata Clear Lake (1780 NASA Parkway    Houston, TX   77058)</option>
                  <option value="2" <?php echo $application->location_apply_for == '2' ? 'selected' : ''?>>Salata Baybrook (700 Baybrook Mall Drive, Ste F160    Friendswood, TX 77546)</option>
                  <option value="3" <?php echo $application->location_apply_for == '3' ? 'selected' : ''?>>Salata Pasadena (4531 E Sam Houston Pkwy S    Pasadena, TX 77505)</option>
                  <option value="4" <?php echo $application->location_apply_for == '4' ? 'selected' : ''?>>Salata League City (2515 Gulf Fwy S, Ste 300    League City, TX  77573)</option>
                  <option value="5" <?php echo $application->location_apply_for == '5' ? 'selected' : ''?>>Salata Kingwood (4523 Kingwood Drive, Ste 150     Kingwood, TX    77345)</option>
                  <option value="6" <?php echo $application->location_apply_for == '6' ? 'selected' : ''?>>Salata Westlake (14237 E Sam Houston Pkwy N, Ste 250    Houston, TX  77044)</option>
                  <option value="7" <?php echo $application->location_apply_for == '7' ? 'selected' : ''?>>Salata Louetta Pines (1600 Louetta Rd, Ste C      Spring, TX  77388)</option>
                </select>
              </div>

              <div class="form-group">
                <label for="first_name">First Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="first_name" value="<?php echo $application->first_name?>" placeholder="">
              </div>

              <div class="form-group">
                <label for="last_name">Last Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="last_name" value="<?php echo $application->last_name?>" placeholder="">
              </div>

              <div class="form-group">
                <label for="middle_name">Middle Name</label>
                <input type="text" class="form-control" name="middle_name" value="<?php echo $application->middle_name?>" placeholder="">
              </div>

              <div class="form-group">
                <label for="preferred_first_name">Preferred First Name</label>
                <input type="text" class="form-control" name="preferred_first_name" value="<?php echo $application->preferred_first_name?>" placeholder="">
              </div>

              <div class="form-group">
                <label for="email">Email Address<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="email" value="<?php echo $application->email?>" placeholder="">
              </div>

              <div class="form-group">
                <label for="cell_phone">Cell Phone Number<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="cell_phone" value="<?php echo $application->cell_phone?>" placeholder="">
              </div>

              <div class="form-group">
                <label for="home_phone">Home Phone Number</label>
                <input type="text" class="form-control" name="home_phone" value="<?php echo $application->home_phone?>" placeholder="">
              </div>

              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="before_apply" name="before_apply" value="1" <?php echo $application->before_apply == '1' ? 'checked' : ''?>>
                  <label for="before_apply" class="custom-control-label">Have you applied for a job with us before?</label>
                </div>
              </div>

              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="age_18" name="age_18" value="1" <?php echo $application->age_18 == '1' ? 'checked' : ''?>>
                  <label for="age_18" class="custom-control-label">Are you at least 18 years of age?</label>
                </div>
              </div>

              <div class="form-group">
                <label>Country</label>
                <select class="form-control" name="country">
                  <option>United States</option>
                </select>
              </div>

              <div class="form-group">
                <label for="address1">Address1<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="address1" value="<?php echo $application->address1?>" placeholder="">
              </div>

              <div class="form-group">
                <label for="address2">Address2</label>
                <input type="text" class="form-control" name="address2" value="<?php echo $application->address2?>" placeholder="">
              </div>

              <div class="form-group">
                <label for="city">City<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="city" value="<?php echo $application->city?>" placeholder="">
              </div>

              <div class="form-group">
                <label for="state">State<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="state" value="<?php echo $application->state?>" placeholder="">
              </div>

              <div class="form-group">
                <label for="zip">Zip Code<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="zip" value="<?php echo $application->zip?>" placeholder="">
              </div>

              <div class="form-group">
                <label>Available Start Date:</label>
                <div class="input-group date" id="start_date" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#start_date" name="start_date" value="<?php echo $application->start_date?>"/>
                    <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
              </div>

              <div class="form-group">
                <label>How did you hear about us?:<span class="text-danger">*</span></label>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="how_hear_indeed" name="how_hear" value="indeed" <?php echo $application->how_hear == 'indeed' ? 'checked' : ''?>>
                  <label for="how_hear_indeed" class="custom-control-label">Indeed</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="how_hear_store_flyer" name="how_hear" value="store_flyer" <?php echo $application->how_hear == 'store_flyer' ? 'checked' : ''?>>
                  <label for="how_hear_store_flyer" class="custom-control-label">Store Flyer</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="how_hear_current_employee" name="how_hear" value="current_employee" <?php echo $application->how_hear == 'current_employee' ? 'checked' : ''?>>
                  <label for="how_hear_current_employee" class="custom-control-label">Current Employee</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="how_hear_online_job_board" name="how_hear" value="online_job_board" <?php echo $application->how_hear == 'online_job_board' ? 'checked' : ''?>>
                  <label for="how_hear_online_job_board" class="custom-control-label">Online Job Board</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="how_hear_company_website" name="how_hear" value="company_website" <?php echo $application->how_hear == 'company_website' ? 'checked' : ''?>>
                  <label for="how_hear_company_website" class="custom-control-label">Company Website</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="how_hear_friend_family" name="how_hear" value="friend_or_family_member" <?php echo $application->how_hear == 'friend_or_family_member' ? 'checked' : ''?>>
                  <label for="how_hear_friend_family" class="custom-control-label">Friend or Family Member</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="how_hear_other" name="how_hear" value="other" <?php echo $application->how_hear == 'other' ? 'checked' : ''?>>
                  <label for="how_hear_other" class="custom-control-label">Other</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Referred by</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="how_hear_referred" value="<?php echo $application->how_hear == 'other' ? $application->how_hear_referred : ''?>">
                  </div>
                </div>
              </div>

              <h4>Job History</h4>
              <div class="form-group">
                <label for="company_name">1. Company Name (present)</label>
                <input type="text" class="form-control" name="company[1][name]" value="<?php echo isset($application->company[0]) ? $application->company[0]['name'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_address">Address</label>
                <input type="text" class="form-control" name="company[1][address]" value="<?php echo isset($application->company[0]) ? $application->company[0]['address'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_city">City</label>
                <input type="text" class="form-control" name="company[1][city]" value="<?php echo isset($application->company[0]) ? $application->company[0]['city'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_state">State</label>
                <input type="text" class="form-control" name="company[1][state]" value="<?php echo isset($application->company[0]) ? $application->company[0]['state'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_phone">Phone</label>
                <input type="text" class="form-control" name="company[1][phone]" value="<?php echo isset($application->company[0]) ? $application->company[0]['phone'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_date_from">Date From</label>
                <input type="text" class="form-control" name="company[1][date_from]" value="<?php echo isset($application->company[0]) ? $application->company[0]['date_from'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_date_to">Date To</label>
                <input type="text" class="form-control" name="company[1][date_to]" value="<?php echo isset($application->company[0]) ? $application->company[0]['date_to'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_salary_starting">Starting Base Salary</label>
                <input type="text" class="form-control" name="company[1][salary_starting]" value="<?php echo isset($application->company[0]) ? $application->company[0]['salary_starting'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_salary_ending">Ending Base Salary</label>
                <input type="text" class="form-control" name="company[1][salary_ending]" value="<?php echo isset($application->company[0]) ? $application->company[0]['salary_ending'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_job">Job Title</label>
                <input type="text" class="form-control" name="company[1][job]" value="<?php echo isset($application->company[0]) ? $application->company[0]['job'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_supervisor">Supervisor</label>
                <input type="text" class="form-control" name="company[1][supervisor]" value="<?php echo isset($application->company[0]) ? $application->company[0]['supervisor'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_reason_leaving">Reason for Leaving</label>
                <input type="text" class="form-control" name="company[1][reason_leaving]" value="<?php echo isset($application->company[0]) ? $application->company[0]['reason_leaving'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_brief_description">Brief Description of Duties (include number of persons supervised, if applicable)</label>
                <textarea class="form-control" rows="3" name="company[1][brief_description]" placeholder=""><?php echo isset($application->company[0]) ? $application->company[0]['brief_description'] : ''?></textarea>
              </div>

              <div class="form-group">
                <label for="company_name">2. Company Name (past)</label>
                <input type="text" class="form-control" name="company[2][name]" value="<?php echo isset($application->company[1]) ? $application->company[1]['name'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_address">Address</label>
                <input type="text" class="form-control" name="company[2][address]" value="<?php echo isset($application->company[1]) ? $application->company[1]['address'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_city">City</label>
                <input type="text" class="form-control" name="company[2][city]" value="<?php echo isset($application->company[1]) ? $application->company[1]['city'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_state">State</label>
                <input type="text" class="form-control" name="company[2][state]" value="<?php echo isset($application->company[1]) ? $application->company[1]['state'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_phone">Phone</label>
                <input type="text" class="form-control" name="company[2][phone]" value="<?php echo isset($application->company[1]) ? $application->company[1]['phone'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_date_from">Date From</label>
                <input type="text" class="form-control" name="company[2][date_from]" value="<?php echo isset($application->company[1]) ? $application->company[1]['date_from'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_date_to">Date To</label>
                <input type="text" class="form-control" name="company[2][date_to]" value="<?php echo isset($application->company[1]) ? $application->company[1]['date_to'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_salary_starting">Starting Base Salary</label>
                <input type="text" class="form-control" name="company[2][salary_starting]" value="<?php echo isset($application->company[1]) ? $application->company[1]['salary_starting'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_salary_ending">Ending Base Salary</label>
                <input type="text" class="form-control" name="company[2][salary_ending]" value="<?php echo isset($application->company[1]) ? $application->company[1]['salary_ending'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_job">Job Title</label>
                <input type="text" class="form-control" name="company[2][job]" value="<?php echo isset($application->company[1]) ? $application->company[1]['job'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_supervisor">Supervisor</label>
                <input type="text" class="form-control" name="company[2][supervisor]" value="<?php echo isset($application->company[1]) ? $application->company[1]['supervisor'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_reason_leaving">Reason for Leaving</label>
                <input type="text" class="form-control" name="company[2][reason_leaving]" value="<?php echo isset($application->company[1]) ? $application->company[1]['reason_leaving'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_brief_description">Brief Description of Duties (include number of persons supervised, if applicable)</label>
                <textarea class="form-control" rows="3" name="company[2][brief_description]" placeholder=""><?php echo isset($application->company[1]) ? $application->company[1]['brief_description'] : ''?></textarea>
              </div>

              <div class="form-group">
                <label for="company_name">3. Company Name (present)</label>
                <input type="text" class="form-control" name="company[3][name]" value="<?php echo isset($application->company[2]) ? $application->company[2]['name'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_address">Address</label>
                <input type="text" class="form-control" name="company[3][address]" value="<?php echo isset($application->company[2]) ? $application->company[2]['address'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_city">City</label>
                <input type="text" class="form-control" name="company[3][city]" value="<?php echo isset($application->company[2]) ? $application->company[2]['city'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_state">State</label>
                <input type="text" class="form-control" name="company[3][state]" value="<?php echo isset($application->company[2]) ? $application->company[2]['state'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_phone">Phone</label>
                <input type="text" class="form-control" name="company[3][phone]" value="<?php echo isset($application->company[2]) ? $application->company[2]['phone'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_date_from">Date From</label>
                <input type="text" class="form-control" name="company[3][date_from]" value="<?php echo isset($application->company[2]) ? $application->company[2]['date_from'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_date_to">Date To</label>
                <input type="text" class="form-control" name="company[3][date_to]" value="<?php echo isset($application->company[2]) ? $application->company[2]['date_to'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_salary_starting">Starting Base Salary</label>
                <input type="text" class="form-control" name="company[3][salary_starting]" value="<?php echo isset($application->company[2]) ? $application->company[2]['salary_starting'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_salary_ending">Ending Base Salary</label>
                <input type="text" class="form-control" name="company[3][salary_ending]" value="<?php echo isset($application->company[2]) ? $application->company[2]['salary_ending'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_job">Job Title</label>
                <input type="text" class="form-control" name="company[3][job]" value="<?php echo isset($application->company[2]) ? $application->company[2]['job'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_supervisor">Supervisor</label>
                <input type="text" class="form-control" name="company[3][supervisor]" value="<?php echo isset($application->company[2]) ? $application->company[2]['supervisor'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_reason_leaving">Reason for Leaving</label>
                <input type="text" class="form-control" name="company[3][reason_leaving]" value="<?php echo isset($application->company[2]) ? $application->company[2]['reason_leaving'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_brief_description">Brief Description of Duties (include number of persons supervised, if applicable)</label>
                <textarea class="form-control" rows="3" name="company[3][brief_description]" placeholder=""><?php echo isset($application->company[2]) ? $application->company[2]['brief_description'] : ''?></textarea>
              </div>


              <div class="form-group">
                <label>Are you able to perform the essential functions for the job which you are applying for, with or without a reasonable accommodation?<span class="text-danger">*</span></label>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="perform_essential_functions_yes" name="perform_essential_functions" value="1" <?php echo $application->perform_essential_functions == '1' ? 'checked' : ''?>>
                  <label for="perform_essential_functions_yes" class="custom-control-label">Yes</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="perform_essential_functions_no" name="perform_essential_functions" value="0" <?php echo $application->perform_essential_functions == '0' ? 'checked' : ''?>>
                  <label for="perform_essential_functions_no" class="custom-control-label">No</label>
                </div>
              </div>

              <div class="form-group">
                <label>Do you have restaurant experience with food preparation?<span class="text-danger">*</span></label>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="restaurant_experience_food_preparation_yes" name="restaurant_experience_food_preparation" value="1" <?php echo $application->restaurant_experience_food_preparation == '1' ? 'checked' : ''?>>
                  <label for="restaurant_experience_food_preparation_yes" class="custom-control-label">Yes</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="restaurant_experience_food_preparation_no" name="restaurant_experience_food_preparation" value="0" <?php echo $application->restaurant_experience_food_preparation == '0' ? 'checked' : ''?>>
                  <label for="restaurant_experience_food_preparation_no" class="custom-control-label">No</label>
                </div>
              </div>

              <div class="form-group">
                <label>Do you have restaurant experience with sanitation guidelines?<span class="text-danger">*</span></label>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="restaurant_experience_sanitation_yes" name="restaurant_experience_sanitation" value="1" <?php echo $application->restaurant_experience_sanitation == '1' ? 'checked' : ''?>>
                  <label for="restaurant_experience_sanitation_yes" class="custom-control-label">Yes</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="restaurant_experience_sanitation_no" name="restaurant_experience_sanitation" value="0" <?php echo $application->restaurant_experience_sanitation == '0' ? 'checked' : ''?>>
                  <label for="restaurant_experience_sanitation_no" class="custom-control-label">No</label>
                </div>
              </div>

              <div class="form-group">
                <label>Are you able to work nights, weekends, and holidays?<span class="text-danger">*</span></label>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="able_work_nights_yes" name="able_work_nights" value="1" <?php echo $application->able_work_nights == '1' ? 'checked' : ''?>>
                  <label for="able_work_nights_yes" class="custom-control-label">Yes</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="able_work_nights_no" name="able_work_nights" value="0" <?php echo $application->able_work_nights == '0' ? 'checked' : ''?>>
                  <label for="able_work_nights_no" class="custom-control-label">No</label>
                </div>
              </div>

              <div class="form-group">
                <label>Do you have a Food Handlers Permit?<span class="text-danger">*</span></label>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="food_handler_permit_yes" name="food_handler_permit" value="1" <?php echo $application->food_handler_permit == '1' ? 'checked' : ''?>>
                  <label for="food_handler_permit_yes" class="custom-control-label">Yes</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="food_handler_permit_no" name="food_handler_permit" value="0" <?php echo $application->food_handler_permit == '0' ? 'checked' : ''?>>
                  <label for="food_handler_permit_no" class="custom-control-label">No</label>
                </div>
              </div>

              <div class="form-group">
                <label>If you do not have a Food Handlers Permit, are you willing to obtain one?<span class="text-danger">*</span></label>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="obtain_food_handler_permit_yes" name="obtain_food_handler_permit" value="1" <?php echo $application->obtain_food_handler_permit == '1' ? 'checked' : ''?>>
                  <label for="obtain_food_handler_permit_yes" class="custom-control-label">Yes</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="obtain_food_handler_permit_no" name="obtain_food_handler_permit" value="0" <?php echo $application->obtain_food_handler_permit == '0' ? 'checked' : ''?>>
                  <label for="obtain_food_handler_permit_no" class="custom-control-label">No</label>
                </div>
              </div>

              <div class="form-group">
                <label>Please check all shifts that you are available to work? <span class="text-danger">*</span></label>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="available_to_work_am" name="available_to_work" value="1" <?php echo $application->available_to_work == '1' ? 'checked' : ''?>>
                  <label for="available_to_work_am" class="custom-control-label">AM</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="available_to_work_pm" name="available_to_work" value="2" <?php echo $application->available_to_work == '2' ? 'checked' : ''?>>
                  <label for="available_to_work_pm" class="custom-control-label">PM</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="available_to_work_any" name="available_to_work" value="3" <?php echo $application->available_to_work == '3' ? 'checked' : ''?>>
                  <label for="available_to_work_any" class="custom-control-label">Any</label>
                </div>
              </div>

              <h4>Reference1</h4>
              <div class="form-group">
                <label for="company_name">Name</label>
                <input type="text" class="form-control" name="reference[1][name]" value="<?php echo isset($application->reference[0]) ? $application->reference[0]['name'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_address">Email</label>
                <input type="text" class="form-control" name="reference[1][email]" value="<?php echo isset($application->reference[0]) ? $application->reference[0]['email'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_city">Phone</label>
                <input type="text" class="form-control" name="reference[1][phone]" value="<?php echo isset($application->reference[0]) ? $application->reference[0]['phone'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_phone">Personal or Work Reference?</label>
                <input type="text" class="form-control" name="reference[1][personal_work]" value="<?php echo isset($application->reference[0]) ? $application->reference[0]['personal_work'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_state">Years Known</label>
                <input type="text" class="form-control" name="reference[1][years]" value="<?php echo isset($application->reference[0]) ? $application->reference[0]['years'] : ''?>" placeholder="">
              </div>

              <h4>Reference2</h4>
              <div class="form-group">
                <label for="company_name">Name</label>
                <input type="text" class="form-control" name="reference[2][name]" value="<?php echo isset($application->reference[1]) ? $application->reference[0]['name'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_address">Email</label>
                <input type="text" class="form-control" name="reference[2][email]" value="<?php echo isset($application->reference[1]) ? $application->reference[0]['email'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_city">Phone</label>
                <input type="text" class="form-control" name="reference[2][phone]" value="<?php echo isset($application->reference[1]) ? $application->reference[0]['phone'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_phone">Personal or Work Reference?</label>
                <input type="text" class="form-control" name="reference[2][personal_work]" value="<?php echo isset($application->reference[0]) ? $application->reference[1]['personal_work'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_state">Years Known</label>
                <input type="text" class="form-control" name="reference[2][years]" value="<?php echo isset($application->reference[1]) ? $application->reference[0]['years'] : ''?>" placeholder="">
              </div>

              <h4>Reference3</h4>
              <div class="form-group">
                <label for="company_name">Name</label>
                <input type="text" class="form-control" name="reference[3][name]" value="<?php echo isset($application->reference[2]) ? $application->reference[0]['name'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_address">Email</label>
                <input type="text" class="form-control" name="reference[3][email]" value="<?php echo isset($application->reference[2]) ? $application->reference[0]['email'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_city">Phone</label>
                <input type="text" class="form-control" name="reference[3][phone]" value="<?php echo isset($application->reference[2]) ? $application->reference[0]['phone'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_phone">Personal or Work Reference?</label>
                <input type="text" class="form-control" name="reference[3][personal_work]" value="<?php echo isset($application->reference[0]) ? $application->reference[2]['personal_work'] : ''?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="company_state">Years Known</label>
                <input type="text" class="form-control" name="reference[3][years]" value="<?php echo isset($application->reference[2]) ? $application->reference[0]['years'] : ''?>" placeholder="">
              </div>
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-primary" id="btn_update">Submit</button>
            </div>
          </div>
          <input type="hidden" name="application_id" value="<?php echo $application_id?>">
        </form>
      </div>
    </div>

  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>
$(document).ready(function() {
    //Date picker
    $('#start_date').datetimepicker({
        format: 'L'
    });

    $(document).on('click', '#btn_update', function() {
      var formdata = new FormData($('#form_application')[0]);
      $.ajax({
        url: base_url + '/update-application',
        type: 'post',
        enctype: 'multipart/form-data',
        data: formdata,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(resp){
            if(resp.success) {
              alert('Updated Successfully!');
            }
            else {
              alert(resp.message);
            }
        }
      })    
    })
  })

</script>