@extends('layout.app')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10">
                <h1 class="text-center mb-4">Job Detail</h1>

                <!-- Designation -->
                <div class="mb-4">
                    <h2>Designation</h2>
                    <p id="type"></p>
                </div>

                <!-- Salary -->
                <div class="mb-4">
                    <h2>Salary</h2>
                    <p id="salary"></p>
                </div>

                <!-- Requirements -->
                <div class="mb-4">
                    <h2>Requirements</h2>
                    <div id="requirements">
                    </div>
                </div>

                <!-- Specialties -->
                <div class="mb-4">
                    <h2>Specialties</h2>
                    <div id="specialties">
                    </div>
                </div>

                <!-- Specialties -->
                <div class="mb-4">
                    <h2>Responsibilities</h2>
                    <div id="responsibilities">
                    </div>
                </div>

                <!-- Company Name -->
                <div class="mb-4">
                    <h2>Company Name</h2>
                    <p id="companyName"></p>
                </div>

                <!-- Location -->
                <div class="mb-4">
                    <h2>Location</h2>
                    <p id="location"></p>
                </div>

                <!-- Company Name -->
                <div class="mb-4">
                    <h2>Compensations</h2>
                    <p id="compensations"></p>
                </div>

                <!-- Deadline -->
                <div class="mb-4">
                    <h2>Deadline</h2>
                    <p id="deadline"></p>
                </div>

            </div>
            <div class="d-flex justify-content-center align-items-center py-2 text-lg" id="applyJob">
                adfasdfdf
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

                document.getElementById('type').innerHTML = res.data['rows']['type']
                document.getElementById('salary').innerHTML = res.data['rows']['salary'] + " tk."
                document.getElementById('requirements').innerHTML = res.data['rows']['requirements']
                document.getElementById('specialties').innerHTML = specialities
                document.getElementById('responsibilities').innerHTML = res.data['rows']['responsibilities']
                document.getElementById('companyName').innerHTML = res.data['rows']['user']['firstName']
                document.getElementById('location').innerHTML = res.data['rows']['location']
                document.getElementById('compensations').innerHTML = res.data['rows']['compensations']
                document.getElementById('deadline').innerHTML = new Date(res.data['rows']['deadline'])
                    .toLocaleDateString()
                document.getElementById('applyJob').innerHTML =
                    `<button class="btn btn-lg btn-danger" onclick="applyJob(${res.data['rows']['id']})">Apply</button>`;

            } catch (e) {
                unauthorized(e.response.status)
            }
        }

        async function applyJob(jobId) {
            // console.log({jobId});
            try {
                let PostBody = {
                    "id": jobId,
                }
                showLoader();
                let res = await axios.post("/api/apply-job", PostBody, HeaderToken())
                hideLoader();

            } catch (e) {
                unauthorized(e.response.status)
            }

        }
    </script>
@endsection
