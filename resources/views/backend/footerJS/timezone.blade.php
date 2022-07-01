<script type="text/javascript">
    function showTime() {
      const month = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
      var d = new Date();
      var utcOffset=d.getTimezoneOffset();
      d.setMinutes(d.getMinutes()+utcOffset);
     
  
      var myTime=8*60;
      d.setMinutes(d.getMinutes() + myTime);
      
      let hours=d.getHours();
      let minutes=d.getMinutes();
      let ampm=hours>=12? 'PM' :'AM';
      hours = hours ? hours : 12; // the hour '0' should be '12'
      minutes = minutes < 10 ? '0'+minutes : minutes;

      const days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
 
      let Tostring=month[d.getMonth()] +" "+d.getDate() +"," +d.getFullYear()+",";
      let GetTime=d.getHours() +":" + d.getMinutes() +":" +d.getSeconds() +' '+ampm;
      
  
      document.getElementById('time').innerHTML = "Server Time : " +days[d.getDay()] +" " + Tostring +" " + GetTime ;
    }
  
   setInterval(showTime, 1000);
  </script>
  