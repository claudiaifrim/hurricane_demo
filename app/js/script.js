$(function() {
  $("#search-hurricane").click(function() {
    var name = $("#hurricane-name").val().trim();
    var year = $("#season-range").val().trim();

    if(name == ''){
      alert("Please enter a name in order to search for a hurricane!");
    } else {
      $.ajax({
        type: "POST",
        url: "hurricane.php",
        data: {
          hurricane_name: name,
          season_range: year
        },
        success: function(response){
          if(Object.getOwnPropertyNames(response).length === 0){
            var results = "<ul>";
            results +="<li>No results for '" + name + "'.</li>"
            results += "</ul>";
            $('#results-hurricanes').html(results);
          } else {
            var results = "<ul>";

            for(var key in response) {
              results +="<li><a href='"+response[key].hurricaneurl+" target='_blank'>" + response[key].name + "</a> | " + response[key].country + " | " + response[key].province + " | " + response[key].year + "</li>" 
            }
            results += "</ul>";
            $('#results-hurricanes').html(results);
          }
          $("#hurricane-name").val('');
          $("#season-range").val()
          
          console.dir(response);
        },
        error: function(error) {
          alert("An error has occured!");
          $('#results-hurricanes').html("");
        }
      });
    }
    return false;
  });


  $("#search-area").click(function() {
    var name = $("#area-name").val().trim();

    if(name == ''){
      alert("Please enter a name of a country or of an administrative area in order to search for a area!");
    } else {
      $.ajax({
        type: "POST",
        url: "area.php",
        data: {
          area_name: name
        },
        success: function(response){
          if(Object.getOwnPropertyNames(response).length === 0){
            var results = "<ul>";
            results +="<li>No results for '"+ name + "'.</li>"
            results += "</ul>";
            $('#results-areas').html(results);
          } else {
            var results = "<ul>";

            for(var key in response) {
              results +="<li>" + response[key] + "</li>" 
            }
            results += "</ul>";
            $('#results-areas').html(results);
          }
          $("#area-name").val('');
          console.dir(response);
        },
        error: function(error) {
          alert("An error has occured!");
          $('#results-areas').html("");
        }
      });
    }
    return false;
  });
});