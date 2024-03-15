@extends('layout.app')

@section('content')

<div class="row">
    <div class="col">
    <div class="d-flex justify-content-center" role="alert" id="banner">
    </div>
    </div>
</div>
 
<div class="p-5">
    <h5 class="text-center pb-2">Company History</h5>
    <div class="d-flex justify-content-center align-content-center">
        <div class="col-10" id="companyHistory">
        </div>

    </div>
</div>
<div class="p-5">
    <h5 class="text-center pb-2">Our Vision</h5>
    <div class="d-flex justify-content-center align-content-center">
        <div class="col-10" id="ourVision">
        </div>
    </div>
</div>

<div class="p-5">
    <h5 class="text-center pb-2">Companies believe in us</h5>
    <div class="d-flex justify-content-center gap-4" id="companySection">
    </div>
</div>

 <script>
    let companyContainer = '';
    
    getAboutSetting();
    
    async function getAboutSetting() {
    
        try {
            showLoader();
            let res=await axios.get("/api/get-about-setting");
            hideLoader();
            // console.log(res.data['about']);
            document.getElementById('banner').innerHTML = `
            <img src="${window.location.origin}/${res.data['about']['banner']}" style="width:100%; height:450px"/>
            `
            document.getElementById('companyHistory').innerHTML = res.data['about']['company_history'];
            document.getElementById('ourVision').innerHTML = res.data['about']['our_vision'];

            res.data['company'].forEach(function (item,index) {
                companyContainer +=`
                        <div class="card bg-info">
                            <div class="card-body">
                                <h5 class="card-title text-center text-white">${item['firstName']}</h5>
                            </div>
                        </div>
                        `
            })

            document.getElementById('companySection').innerHTML = companyContainer;

        }catch (e) {
            unauthorized(e.response.status)
        }
    
    }
    
 
    
    
    </script>
@endsection
