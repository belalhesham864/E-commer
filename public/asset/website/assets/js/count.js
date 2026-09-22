    function startCountdown(){
        const now=new Date();
        const endOfDay=new Date();
      endOfDay.setHours(23,59,59,999);

      const diff=endOfDay-now;
      if(diff<0){
        $('#day,#hour,#minute,#second').text("0");
        return;
      }

      const totalSecound=Math.floor(diff/1000);
      const hours=Math.floor((totalSecound%86400)/3600);
      const minutes=Math.floor((totalSecound%3600)/60);
      const secounds=Math.floor(totalSecound%60);

      $('#day').text('0');
      $('#hour').text(String(hours).padStart(2,'0'));
      $('#minute').text(String(minutes).padStart(2,'0'));
      $('#second').text(String(secounds).padStart(2,'0'));
    }
    $(function(){
        startCountdown();
        setInterval(startCountdown,1000);
    });
