@extends('layout.app')

@section('content')

<div class="container my-5">
    <div class="" id="author">
    </div>
    <div class="" id="blogDetails">
    </div>
</div>
 

 <script>
    getBlogDetails();
    
    async function getBlogDetails() {
        let id = "{{ request()->segment(2) }}"
        try {
            showLoader();
            let res=await axios.post("/api/blog-details", {id: id.toString()},HeaderToken());
            hideLoader();
            
            document.getElementById('author').innerHTML =`<h4><i>Written By-</i>${res.data['rows']['user']['firstName']}</h4>`
            document.getElementById('blogDetails').innerHTML = res.data['rows']['text']

        }catch (e) {
            unauthorized(e.response.status)
        }
    
    }
    
 
    
    
    </script>
@endsection
