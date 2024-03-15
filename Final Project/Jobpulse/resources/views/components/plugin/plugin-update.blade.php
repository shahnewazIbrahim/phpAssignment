<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Plugin</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label mt-2">Type</label>
                                <input type="text" class="form-control" id="pluginTypeUpdate">
                                <label class="form-label mt-2">Specialities</label>
                                <input type="text" class="form-control" id="pluginSpecialitiesUpdate">

                                
                                <label class="form-label mt-2">Requirements</label>
                                <textarea type="text" class="form-control" id="pluginRequirementsUpdate"></textarea>

                                <label class="form-label mt-2">Experience</label>
                                <textarea type="text" class="form-control" id="pluginExperienceUpdate"></textarea>

                                <label class="form-label mt-2">Responsibilities</label>
                                <textarea type="text" class="form-control" id="pluginResponsibilitiesUpdate"></textarea>

                                <label class="form-label mt-2">Compensations</label>
                                <textarea type="text" class="form-control" id="pluginCompensationsUpdate"></textarea>

                                <label class="form-label mt-2">Location</label>
                                <input type="text" class="form-control" id="pluginLocationUpdate">
                                
                                <label class="form-label mt-2">Employee status</label>
                                <select type="text" class="form-control" id="pluginEmployeeStatusUpdate">
                                    <option value="">Select</option>
                                    <option value="Full Time">Full Time</option>
                                    <option value="Part Time">Part Time</option>
                                </select>
                                
                                <label class="form-label mt-2">Salary</label>
                                <input type="text" class="form-control" id="pluginSalaryUpdate">

                                <label class="form-label mt-2">Deadline</label>
                                <input type="date" class="form-control" id="pluginDeadlineUpdate">
                                <input type="text" class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="update()" id="update-btn" class="btn bg-gradient-success" >Update</button>
            </div>

        </div>
    </div>
</div>


<script>
CKEDITOR.replace( 'pluginRequirementsUpdate');
CKEDITOR.replace( 'pluginExperienceUpdate');
CKEDITOR.replace( 'pluginResponsibilitiesUpdate');
CKEDITOR.replace( 'pluginCompensationsUpdate');



    async function FillUpUpdateForm(id){
        try {
            document.getElementById('updateID').value=id;
            showLoader();
            let res=await axios.post("/api/plugin-by-id",{id:id.toString()},HeaderToken())
            hideLoader();
            console.log(res.data['rows']);
            document.getElementById('pluginTypeUpdate').value=res.data['rows']['type'];
            document.getElementById('pluginSpecialitiesUpdate').value=res.data['rows']['specialities'];
            document.getElementById('pluginDeadlineUpdate').value=res.data['rows']['deadline'];
            document.getElementById('pluginSalaryUpdate').value=res.data['rows']['salary'];
            document.getElementById('pluginLocationUpdate').value=res.data['rows']['location'];
            document.getElementById('pluginEmployeeStatusUpdate').value = res.data['rows']['employee_status'];
            document.getElementById('pluginRequirementsUpdate').value = CKEDITOR.instances['pluginRequirementsUpdate'].setData(res.data['rows']['requirements']);
            document.getElementById('pluginExperienceUpdate').value = CKEDITOR.instances['pluginExperienceUpdate'].setData(res.data['rows']['experience']);
            document.getElementById('pluginResponsibilitiesUpdate').value = CKEDITOR.instances['pluginResponsibilitiesUpdate'].setData(res.data['rows']['responsibilities']);
            document.getElementById('pluginCompensationsUpdate').value = CKEDITOR.instances['pluginCompensationsUpdate'].setData(res.data['rows']['compensations']);
            
            
        }catch (e) {
            unauthorized(e.response.status)
        }
    }



    async function update() {

        try {
            let pluginTypeUpdate=document.getElementById('pluginTypeUpdate').value;
            let pluginSpecialitiesUpdate=document.getElementById('pluginSpecialitiesUpdate').value;
            let pluginDeadlineUpdate=document.getElementById('pluginDeadlineUpdate').value;
            let pluginSalaryUpdate=document.getElementById('pluginSalaryUpdate').value;
            let pluginLocationUpdate = document.getElementById('pluginLocationUpdate').value;
            let pluginEmployeeStatusUpdate = document.getElementById('pluginEmployeeStatusUpdate').value;

            let pluginRequirementsUpdate = CKEDITOR.instances['pluginRequirementsUpdate'].getData();
            let pluginExperienceUpdate = CKEDITOR.instances['pluginExperienceUpdate'].getData();
            let pluginResponsibilitiesUpdate = CKEDITOR.instances['pluginResponsibilitiesUpdate'].getData();
            let pluginCompensationsUpdate = CKEDITOR.instances['pluginCompensationsUpdate'].getData();

            let updateID=document.getElementById('updateID').value;
            document.getElementById('update-modal-close').click();
            
            // return console.log(343);
            let PostBody= {
                "type":pluginTypeUpdate,
                "specialities":pluginSpecialitiesUpdate,
                "deadline":pluginDeadlineUpdate,
                "salary":pluginSalaryUpdate,
                "requirements":pluginRequirementsUpdate,
                "experience":pluginExperienceUpdate,
                "responsibilities":pluginResponsibilitiesUpdate,
                "compensations":pluginCompensationsUpdate,
                "location":pluginLocationUpdate,
                "employee_status":pluginEmployeeStatusUpdate,
                "id":updateID
            }

            showLoader();
            let res = await axios.post("/api/update-plugin",PostBody,HeaderToken())
            hideLoader();
            if(res.data['status']==="success"){
                successToast(res.data['message'])
                await getList();
            }
            else{
                errorToast(res.data['message'])
            }

        }catch (e) {
            unauthorized(e.response.status)
        }

    }
</script>
