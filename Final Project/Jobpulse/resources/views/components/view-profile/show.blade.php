  <style>
      /* Custom styling */
      .profile-img {
          width: 250px;
          height:  250px;
          border-radius: 50%;
      }

      .section-title {
          font-size: 24px;
          margin-top: 20px;
      }

      .info-list li {
          margin-bottom: 10px;
      }
  </style>

  <div class="container">
      <div class="row">
          <div class="col-md-4">
              <div class="text-center">
                  <img src="" alt="Profile Picture" class="profile-img">
                  <h2 class="name"></h2>
                  <p class="occupation"></p>
              </div>
          </div>
          <div class="col-md-8">
              <div class="section">
                  <h3 class="section-title">Contact Information</h3>
                  <ul class="info-list">
                      <li><strong>Email:</strong> <span class="email"></span></li>
                      <li><strong>Phone:</strong> <span class="mobile"></span></li>
                      <li><strong>Address:</strong> <span class="address"></span></li>
                  </ul>
              </div>
              <div class="section">
                  <h3 class="section-title">Education</h3>
                  <span class="hons py-2"></span>
                  <span class="hsc py-2"></span>
                  <span class="ssc py-2"></span>
              </div>
              <div class="section">
                  <h3 class="section-title">Experience</h3>
                  <span class="experience"></span>
              </div>
          </div>
      </div>
  </div>
  <script>
      getList();


      async function getList() {

          // try {
          let id = "{{ request()->segment(3) }}"
          showLoader();
          let res = await axios.post("/api/view-profile", {
              id: id
          }, HeaderToken());
          hideLoader();
          // return console.log(res.data['user']['candidate']);
          document.querySelector('.profile-img').src =
              `${window.location.origin}/${res.data['user']['candidate']['image']}`;
          document.querySelector('.email').innerHTML = res.data['user']['email'];
          document.querySelector('.mobile').innerHTML = res.data['user']['mobile'];
          document.querySelector('.address').innerHTML = res.data['user']['candidate']['address'];
          document.querySelector('.occupation').innerHTML = res.data['user']['candidate']['occupation'];
          document.querySelector('.hons').innerHTML = res.data['user']['candidate']['hons'];
          document.querySelector('.hsc').innerHTML = res.data['user']['candidate']['hsc'];
          document.querySelector('.ssc').innerHTML = res.data['user']['candidate']['ssc'];
          document.querySelector('.experience').innerHTML = res.data['user']['candidate']['other_qualification'];

          return console.log(res.data);




          // }catch (e) {
          //     unauthorized(e.response.status)
          // }

      }
  </script>
