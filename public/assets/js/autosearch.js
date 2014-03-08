var thumbnailpath = "http://d3gtl9l2a4fn1j.cloudfront.net/t/p/w45";
var noimg = "'none'";
var tvArray = [];

// instantiate the bloodhound suggestion engine
var tvshows = new Bloodhound({
    datumTokenizer: function (d) {
        return Bloodhound.tokenizers.whitespace(d.value);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        url: 'http://api.themoviedb.org/3/search/tv?query=%QUERY&api_key=ca85ff10880b1490989e8dbeb5932c00',
        filter: function (tvshows) {
            return $.map(tvshows.results, function (tvshow) {
                var popular = tvshow.popularity;
                if(tvshow.first_air_date){
                  var year = tvshow.first_air_date.substr(0,4);
                  var yearParenths = '('+year+')';
                  return {
                    id: tvshow.id,
                    title: tvshow.name,
                    poster: tvshow.poster_path,
                    year: yearParenths,
                    popularity: popular.toFixed(2)
                };
              }
                else{
                  return {
                      id: tvshow.id,
                      title: tvshow.name,
                      poster: tvshow.poster_path,
                      year: ' ',
                      popularity: popular.toFixed(2)
                  };
                }
            });
        }
    }
});

var movies = new Bloodhound({
    datumTokenizer: function (d) {
        return Bloodhound.tokenizers.whitespace(d.value);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        url: 'http://api.themoviedb.org/3/search/movie?query=%QUERY&api_key=ca85ff10880b1490989e8dbeb5932c00',
        filter: function (movies) {
            return $.map(movies.results, function (movie) {
              var popular = movie.popularity;
              if(movie.release_date)
              {
                var year = movie.release_date.substr(0,4);
                var yearParenths = '('+year+')';
                var thumbnail = thumbnailpath+movie.poster_path;
                return {
                    id: movie.id,
                    title: movie.original_title,
                    image: thumbnail,
                    year: yearParenths,
                    popularity: popular.toFixed(2),
                    type: 'film'
                };
              }else{                  
                return {
                    id: movie.id,
                    title: movie.original_title,
                    image: thumbnail,
                    year: ' ',
                    popularity: popular.toFixed(2),
                    type: 'film'
                  };
                }
            });
        }
    }
});
var people = new Bloodhound({
    datumTokenizer: function (d) {
        return Bloodhound.tokenizers.whitespace(d.value);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        url: 'http://api.themoviedb.org/3/search/person?query=%QUERY&api_key=ca85ff10880b1490989e8dbeb5932c00',
        filter: function (people) {
            return $.map(people.results, function (person) {
                return {
                    id: person.id,
                    name: person.name,
                    photo: person.profile_path
                };
            });
        }
    }
});

movies.initialize();
tvshows.initialize();
people.initialize();

$('.auto-search .typeahead').typeahead({
  highlight: true,
  minLength: 0,
},
{
  name: 'movies',
  displayKey: 'title',
  source: movies.ttAdapter(),
  templates: {
    header: '<h4 class="category">Movies</h4>',
    suggestion: Handlebars.compile(
      '<div class="query-box"><img src="{{image}}" onerror="this.style.display='+noimg+'" height="53" width="40" align="left"/><span class="query-text">{{title}} {{year}}</span</div>'
    )
  }
},
{
  name: 'tvshows',
  displayKey: 'title',
  source: tvshows.ttAdapter(),
  templates: {
    header: '<h4 class="category">TV Shows</h4>',
    suggestion: Handlebars.compile(
      '<div class="query-box"><img src="'+thumbnailpath+'{{poster}}" onerror="this.style.display='+noimg+'" height="53" width="40" float:left/>'+ '<span class="query-text">{{title}} {{year}}</span></div>'
    )

  }
},
{
  name: 'people',
  displayKey: 'name',
  source: people.ttAdapter(),
  templates: {
    header: '<h4 class="category">People</h4>',
    suggestion: Handlebars.compile(
      '<div class="query-box"><img src="'+thumbnailpath+'{{photo}}" onerror="this.style.display='+noimg+'" align="left"/>'+ '<span class="query-text">{{name}}</span></div>'
    )
  }


}) .on("typeahead:selected", function (event, data, dataset) {
      if(data.type=='film')
        window.location.href = "/movie/" + encodeURIComponent(data.id);
    });
