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

 <script>

    getAboutSetting();
    
    async function getAboutSetting() {
    
        try {
            showLoader();
            let res=await axios.get("/api/get-about-setting",HeaderToken());
            hideLoader();
            // console.log(res.data);
            document.getElementById('banner').innerHTML = `
            <img src="${window.location.origin}/${res.data['banner']}" style="width:100%; height:400px"/>
            `
            document.getElementById('companyHistory').innerHTML = res.data['company_history'];
            document.getElementById('ourVision').innerHTML = res.data['our_vision'];
        }catch (e) {
            unauthorized(e.response.status)
        }
    
    }
 
    
    
    </script>
@endsection
