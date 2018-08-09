 	<div class="sticky-top">
  	<div class="btn-group breadcrumb-success btn-breadcrumb">
            <a href="{{asset('client/home')}}" class="btn btn-successs"><i class="fa fa-home"></i></a>
            <a href="#" class="btn btn-successs visible-lg-block visible-md-block" id="first">APPLY</a>
              <a href="#" class="btn btn-successs visible-lg-block visible-md-block" id="second">PAYMENT</a>
            <a href="#" class="btn btn-successs visible-lg-block visible-md-block" id="third">EVALUATION STATUS</a>
            <a href="#" class="btn btn-successs visible-lg-block visible-md-block" id="fourth">INSPECTION STATUS</a>
            <a href="#" class="btn btn-successs visible-lg-block visible-md-block" id="fifth">ISSUANCE</a>
        </div>
  </div>
        <style type="text/css">
        	.btn-group{
  z-index: 2;
}
.btn-successs{
      color: #fff;
    background-color: #5cb85c;
}
.btn-breadcrumb{
  padding-left: 100px;
  width: 100%;
  background-color: #fff;
  border-radius: 0;
  margin: auto;
}
.btn-breadcrumb .btn{
  border-color: transparent; border: 0px solid transparent;
  border-right: 1px solid transparent !important; 
  font-size: 11px;
}

.breadcrumb-success{ background-color: #5cb85c; }

.btn-breadcrumb .btn:after {
  content: " ";
  display: block;
  width: 0;
  height: 0;
  border-top: 13px solid transparent;
  border-bottom: 14px solid transparent;
  border-left: 10px solid white;
  position: absolute;
  top: 50%;
  margin-top: -14px;
  margin-left: 0px;
  left: 100%;
  z-index: 3;
}
.btn-breadcrumb .btn:before {
  content: " ";
  display: block;
  width: 0;
  height: 0;
  border-top: 13px solid transparent;
  border-bottom: 14px solid transparent;
  border-left: 10px solid rgb(173, 173, 173);
  position: absolute;
  top: 50%;
  margin-top: -14px;
  margin-left: 1px;
  left: 100%;
  z-index: 3;
}

/** The Spacing **/
.btn-breadcrumb .btn {padding:6px 12px 6px 24px;}
/** Success button **/
.btn-breadcrumb .btn.btn-successs:after {border-left: 10px solid #5cb85c;}
.btn-breadcrumb .btn.btn-successs:hover:after {border-left: 10px solid #5cb85c;}
.btn-breadcrumb .btn.btn-successs:hover:before, .btn-breadcrumb .btn.btn-successs:before {border-left: 10px solid #398439;}
@media only screen and (max-width: 1125px){
	.btn-group{
		padding-left: 80px;
	}
}
@media only screen and (max-width: 575px){
	.btn-group{
		padding-left: 0px;
	}
}

        </style>
        <script>
        	setInterval(function(e){
	        	var first, second, third, fourth;
	        	first = document.getElementById("first");
	        	second = document.getElementById("second");
	        	third = document.getElementById("third");
	        	fourth = document.getElementById("fourth");
            fifth = document.getElementById("fifth");
        		if(window.innerWidth < 530){
	        		if(first.getElementsByTagName('i')[0] != null || first.getElementsByTagName('i')[0] != undefined) {

	        		} else {
	        			if(first.style.color == "") {
	        				first.innerHTML = "<i class='fa fa-edit'></i>";
	        			}
	        		}
              if(second.getElementsByTagName('i')[0] != null || second.getElementsByTagName('i')[0] != undefined) {

              } else {
                if(second.style.color == "") {
                  second.innerHTML = "<i class='fa fa-credit-card'></i>";
                }
              }
	        		if(third.getElementsByTagName('i')[0] != null || third.getElementsByTagName('i')[0] != undefined) {

	        		} else {
	        			if(third.style.color == "") {
	        				third.innerHTML = "<i class='fa fa-check'></i>";
	        			}
	        		}
	        		if(fourth.getElementsByTagName('i')[0] != null || fourth.getElementsByTagName('i')[0] != undefined) {

	        		} else {
	        			if(fourth.style.color == "") {
	        				fourth.innerHTML = "<i class='fa fa-search'></i>";
	        			}
	        		}
	        		if(fifth.getElementsByTagName('i')[0] != null || fifth.getElementsByTagName('i')[0] != undefined) {

	        		} else {
	        			if(fifth.style.color == "") {
	        				fifth.innerHTML = "<i class='fa fa-print'></i>";
	        			}
	        		}
	        		
	        	} else {
	        		if(first.getElementsByTagName('i')[0] != null || first.getElementsByTagName('i')[0] != undefined) {
	        			first.innerHTML = "APPLY";
	        		}
	        		if(second.getElementsByTagName('i')[0] != null || second.getElementsByTagName('i')[0] != undefined) {
	        			second.innerHTML = "PAYMENT";
	        		}
	        		if(third.getElementsByTagName('i')[0] != null || third.getElementsByTagName('i')[0] != undefined) {
	        			third.innerHTML = "EVALUATION STATUS";
	        		}
	        		if(fourth.getElementsByTagName('i')[0] != null || fourth.getElementsByTagName('i')[0] != undefined) {
	        			fourth.innerHTML = "INSPECTION STATUS";
	        		}
              if(fourth.getElementsByTagName('i')[0] != null || fourth.getElementsByTagName('i')[0] != undefined) {
                fourth.innerHTML = "ISSUANCE";
              }
	        	}
        	}, 1);
        </script>