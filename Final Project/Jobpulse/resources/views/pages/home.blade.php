@extends('layout.app')

@section('content')

<div class="row">
    <div class="col">
    <div class="d-flex justify-content-center" role="alert" id="banner">
    </div>
    </div>
</div>
 
<div class="p-5">
    <h5 class="text-center pb-2">Top Companies</h5>
    <div class="d-flex justify-content-center gap-4" id="companySection">
    </div>
</div>
<div class="p-5">
    <h5 class="text-center pb-2">Recent Published Job</h5>
    <div class="p-3" id="jobSection">
    </div>
</div>

 <script>

    getAboutSetting();
    
    async function getAboutSetting() {
    
        try {
            showLoader();
            let res=await axios.get("/api/get-about-setting",HeaderToken());
            hideLoader();
            // console.log(res.data);
            document.getElementById('banner').innerHTML = `
            <img src="${window.location.origin}/${res.data['about']['banner']}" style="width:100%; height:400px"/>
            `
        }catch (e) {
            unauthorized(e.response.status)
        }
    
    }
    getHomepage();
    
    async function getHomepage() {
        let specialities = '';
        let jobContainer = '';
        let companyContainer = '';
        try {
            showLoader();
            let res=await axios.get("/api/get-homepage",HeaderToken());
            hideLoader();
            // return console.log(typeof res.data['company']);
            res.data['company'].forEach(function (item,index) {
                // console.log(item);
                companyContainer +=`<div class="card bg-info">
                            <div class="card-body">
                            <h5 class="card-title text-center text-white">${item['firstName']}</h5>
                            </div>
                        </div>`
            })
            document.getElementById('companySection').innerHTML = companyContainer 

            res.data['job'].forEach(function (item,index) {
                specialities = ''
                item['specialities'].split(',').forEach((speciality) => {
                    if (speciality) {
                        specialities += `<div class="px-3 py-2 bg-info rounded-2 text-white"> ${speciality}</div>`
                    }
                })
                
                jobContainer += `
                <div class="bg-info px-2 py-3">
                    <div class="bg-white p-2 d-flex justify-content-between flex-wrap">
                        <div>
                            <div class="text-lg font-weight-bold">
                                ${item['type']}
                            </div>
                            <div class="d-flex gap-2">

                                ${specialities}
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-sm btn-secondary" onclick="applyJob(${item['id']})">Apply</button>
                            <div class="text-center">
                                ${item['amount']} tk.
                            </div>
                        </div>
                    </div>
                </div>
                `
            // console.log(item);
            })

            document.getElementById('jobSection').innerHTML = jobContainer 
        }catch (e) {
            unauthorized(e.response.status)
        }
    
    }
    
    async function applyJob(jobId) {
        // console.log({jobId});
        try {
            let PostBody= {
                "id":jobId,
            }
            showLoader();
            let res = await axios.post("/api/apply-job",PostBody,HeaderToken())
            hideLoader();
            // if(res.data['status']==="success"){
            //     successToast(res.data['message'])
            //     await getList();
            // }
            // else{
            //     errorToast(res.data['message'])
            // }
        }catch (e) {
            unauthorized(e.response.status)
        }
    
    }
    </script>
@endsection
