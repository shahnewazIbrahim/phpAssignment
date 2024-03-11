<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Job</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Type</label>
                                <input type="text" class="form-control" id="jobType">

                                <label class="form-label mt-2">Specialities</label>
                                <input type="text" class="form-control" id="jobSpecialities">

                                <label class="form-label mt-2">Requirements</label>
                                <textarea type="text" class="form-control" id="jobRequirements"></textarea>

                                <label class="form-label mt-2">Experience</label>
                                <textarea type="text" class="form-control" id="jobExperience"></textarea>

                                <label class="form-label mt-2">Responsibilities</label>
                                <textarea type="text" class="form-control" id="jobResponsibilities"></textarea>

                                <label class="form-label mt-2">Compensations</label>
                                <textarea type="text" class="form-control" id="jobCompensations"></textarea>

                                <label class="form-label mt-2">Location</label>
                                <input type="text" class="form-control" id="jobLocation">

                                <label class="form-label mt-2">Employee status</label>
                                <select type="text" class="form-control" id="jobEmployeeStatus">
                                    <option value="">Select</option>
                                    <option value="Full Time">Full Time</option>
                                    <option value="Part Time">Part Time</option>
                                </select>

                                <label class="form-label mt-2">Salary</label>
                                <input type="text" class="form-control" id="jobSalary">

                                <label class="form-label mt-2">Deadline</label>
                                <input type="date" class="form-control" id="jobDeadline">

                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn bg-gradient-primary mx-2" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="Save()" id="save-btn" class="btn bg-gradient-success" >Save</button>
                </div>
            </div>
    </div>
</div>


<script>

CKEDITOR.replace( 'jobRequirements');
CKEDITOR.replace( 'jobExperience');
CKEDITOR.replace( 'jobResponsibilities');
CKEDITOR.replace( 'jobCompensations');


    async function Save() {
        try {
            

            let jobType=document.getElementById('jobType').value;
            let jobSpecialities = document.getElementById('jobSpecialities').value;
            let jobDeadline = document.getElementById('jobDeadline').value;
            let jobLocation = document.getElementById('jobLocation').value;
            let jobEmployeeStatus = document.getElementById('jobEmployeeStatus').value;
            let jobSalary = document.getElementById('jobSalary').value;
            let jobRequirements= CKEDITOR.instances[ 'jobRequirements'].getData();
            let jobExperience= CKEDITOR.instances[ 'jobExperience'].getData();
            let jobResponsibilities= CKEDITOR.instances[ 'jobResponsibilities'].getData();
            let jobCompensations = CKEDITOR.instances[ 'jobCompensations'].getData();
            document.getElementById('modal-close').click();

            let PostBody= {
                "type":jobType,
                "specialities":jobSpecialities,
                "deadline":jobDeadline,
                "salary":jobSalary,
                "requirements":jobRequirements,
                "experience":jobExperience,
                "responsibilities":jobResponsibilities,
                "compensations":jobCompensations,
                "location":jobLocation,
                "employee_status":jobEmployeeStatus,
            }

            showLoader();
            let res = await axios.post("/api/create-job",PostBody,HeaderToken())
            document.getElementById("save-form").reset();
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
