@extends('layout.app')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10">
                <h1 class="text-center mb-4">Job Detail</h1>

                <!-- Designation -->
                <div class="mb-4">
                    <h4>Designation</h4>
                    <p id="type"></p>
                </div>

                <!-- Designation -->
                <div class="mb-4">
                    <h4>Employee Status</h4>
                    <p id="employeeStatus"></p>
                </div>

                <!-- Salary -->
                <div class="mb-4">
                    <h4>Salary</h4>
                    <p id="salary"></p>
                </div>

                <!-- Requirements -->
                <div class="mb-4">
                    <h4>Requirements</h4>
                    <div id="requirements">
                    </div>
                </div>

                <!-- Specialties -->
                <div class="mb-4">
                    <h4>Specialties</h4>
                    <div id="specialties">
                    </div>
                </div>

                <!-- Specialties -->
                <div class="mb-4">
                    <h4>Responsibilities</h4>
                    <div id="responsibilities">
                    </div>
                </div>

                <!-- Company Name -->
                <div class="mb-4">
                    <h4>Company Name</h4>
                    <p id="companyName"></p>
                </div>

                <!-- Location -->
                <div class="mb-4">
                    <h4>Location</h4>
                    <p id="location"></p>
                </div>

                <!-- Company Name -->
                <div class="mb-4">
                    <h4>Compensations</h4>
                    <p id="compensations"></p>
                </div>

                <!-- Deadline -->
                <div class="mb-4">
                    <h4>Deadline</h4>
                    <p id="deadline"></p>
                </div>

            </div>
            <div class="d-flex justify-content-center align-items-center py-2 text-lg" id="applyJob">
                
            </div>
        </div>
    </div>
    <script>
        getDetail();

        async function getDetail() {
            let id = "{{ request()->segment(2) }}";
            let specialities = '';
            try {
                showLoader();
                let res = await axios.post("/api/job-detail", {
                    id: id.toString()
                }, HeaderToken());
                hideLoader();
                specialities = ''
                res.data['rows']['specialities'].split(',').forEach((speciality) => {
                    if (speciality) {
                        specialities += `<li class="px-3 py-2 rounded-2"> ${speciality}</li>`
                    }
                })
                let button = res.data['rows']['is_applied_by_user'] 
                    ? `<button class="btn btn-lg btn-success">Applied</button>`
                    : `<button class="btn btn-lg btn-danger" onclick="applyJob(${res.data['rows']['id']})">Apply</button>`; 
                document.getElementById('type').innerHTML = res.data['rows']['type']
                document.getElementById('employeeStatus').innerHTML = res.data['rows']['employee_status']
                document.getElementById('salary').innerHTML = res.data['rows']['salary'] + " tk."
                document.getElementById('requirements').innerHTML = res.data['rows']['requirements']
                document.getElementById('specialties').innerHTML = specialities
                document.getElementById('responsibilities').innerHTML = res.data['rows']['responsibilities']
                document.getElementById('companyName').innerHTML = res.data['rows']['user']['firstName']
                document.getElementById('location').innerHTML = res.data['rows']['location']
                document.getElementById('compensations').innerHTML = res.data['rows']['compensations']
                document.getElementById('deadline').innerHTML = new Date(res.data['rows']['deadline'])
                    .toLocaleDateString()
                document.getElementById('applyJob').innerHTML = button;

            } catch (e) {
                unauthorized(e.response.status)
            }
        }

        async function applyJob(jobId) {
            // return console.log(!getToken());
            try {
                if(!getToken()) {
                    return window.location.href = '/userLogin?type=Candidate'
                }
                if (confirm("Are you want to apply this post?")) {
                    let PostBody= {
                        "id":jobId,
                    }
                    showLoader();
                    let res = await axios.post("/api/apply-job",PostBody,HeaderToken())
                    hideLoader();
                    
                    if(res.data['status']==="success"){
                        successToast(res.data['message'])
                    }else{
                        errorToast(res.data['message'])
                    }
                }
                
            }catch (e) {
                unauthorized(e.response.status)
            }
        
        }
    </script>
@endsection
