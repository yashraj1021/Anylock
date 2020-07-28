
@extends("layouts.master")

@section('body')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
        // Globals
        var curLocation = 0;
        var shapes = <?php echo json_encode($shapes); ?>;
        var locations = <?php echo json_encode($locations); ?>;    

        $(function(){ //On Load
            // $('form').submit(function(e){
            //     e.preventDefault();
            // });

            console.log("Shapes: "+shapes);

            for(var i = 0; i < locations.length; i++){
                $("#location").append("<option>"+locations[i]+"</option>");
            }

            for(var i = 1; i < 3; i++){
                $('#duration').append("<option>"+plusMonth(i)+"</option>");
            }

    
            $("#location").on("change", function(){

                changeLocation($("#location").find("option").index($("#location").find("option:selected")) -1);
                getLockersFromLocation().then(data =>{
                    var lockerCount = 0;
                    $(".Lockers").html("");
                    for(var i = 0; i < shapes[curLocation].length; i++){
                        $(".Lockers").append("<div id='locker-col"+i+"' class='col'></div>")
                        for(var j = 0; j < shapes[curLocation][i] && lockerCount < data.length; j++){
                            $("#locker-col"+i).append("<label class='locker'><input type='radio' name='id' class='radio-locker' value='"+data[lockerCount]["id"]+"'><span>"+data[lockerCount]["locker_num"]+": "+data[lockerCount]["status"]+"</span></label><br>");
                            lockerCount++;
                        }
                    }
                });   
            });
        });

        function plusMonth(num){
            var date = new Date();
            if(num > 0){
                var dateM = new Date(date.setMonth(date.getMonth()+num));
                return dateM.toLocaleString("en-US");
            }

            return 0;
        }
        
        function changeLocation(num){
            if (num < shapes.length && num > -1)
                curLocation = num;
        }

        async function getLockersFromLocation(){
            var data = await axios.get("{{route("getLockersLocation")}}" + "/" + locations[curLocation]);
            console.log(data);
            console.log(data["data"]);
            return data["data"];
        }
    </script>

    <style type="text/css">
        .Lockers{
            width: 90%;
            height: 300px;
            border: solid black 1px;
        }
        .radio-locker{
            display: none;
        }

        .locker {
          display: inline-block;
          padding: 5px 10px;
          cursor: pointer; 
          background-image: url("images/locker.gif");
          background-size: 100% 100%;
          height: 25%;
        }

        .locker span {
          position: relative;
          line-height: 22px;
        }

        .locker span:before, .locker span:after {
          content: '';
        }

        .locker span:before {
          border: 1px solid #222021;
          width: 20px;
          height: 20px;
          margin-right: 10px;
          display: inline-block;
          vertical-align: top;
        }

        .locker span:after {
          background: #222021;
          width: 14px;
          height: 14px;
          position: absolute;
          top: 2px;
          left: 3px;
          transition: 300ms;
          opacity: 0;
        }
        .locker input:checked+span:after {
          opacity: 1;
        }  
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Locker Rental Page</div>

                    <div class="card-body">
                        <p>
                            Select a Locker
                            <form action="{{ route('tryRent') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group col">
                                    <label for="location">Location</label>
                                    <select id="location" name="location" class="form-control">
                                        <option selected disabled>Please Select Location</option>
                                    </select>
                                </div>
                                <div class="Lockers row">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="duration">Rental Duration</label>
                                    <select id="duration" name="duration" class="form-control">
                                        <option selected disabled="">Please Select</option>
                                    </select>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </form>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
