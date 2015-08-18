<?php

/**
 * Description of permissions
 *
 * @author Lahiru
 */
$frame=new  FrameGUI();

$body=      '	<form class="form-horizontal">
			  <fieldset>
				<legend>Alter current permission for users</legend>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Enter employee no. </label>
				  <div class="controls">
                                        <input type="text" />
					<p class="help-block">Enter the employee number of officer</p>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="select01">Special role</label>
                                <div class="controls">
                                        <select class="chzn-select chzn-done" style="width:25%;" id="searchSelect" name="searchselect">
                                                <option>None</option>
                                                <option>Payroll-Ofiicer</option>
                                                <option>Head of HR</option>
                                                <option>HR Partner-LOLC</option>
                                                <option>Feeder-DLG</option>
                                                <option selected="">Feeder-FST</option>
                                                <option>Feeder-LNE</option>
                                                <option>Feeder-LNE</option>
                                                <option>Feeder-MBT</option>
                                                <option>Feeder-MBC</option>
                                                <option>Feeder-NPY</option>
                                                <option>Feeder-OVT</option>
                                                <option>Feeder-RMT</option>
                                                <option>Feeder-RSG</option>
                                        </select> 
                                </div>
                                <button type="resrt" class="btn btn-primary">Select</button>
				</div>

				<div class="form-actions">
				  <button type="submit" class="btn btn-primary">Save changes</button>
				  <button type="reset" class="btn">Cancel</button>
				</div>
			  </fieldset>
			</form>';
    $frame->echoBlock("Change permissons", $body);
   ?>