var thumbnailpath = "http://d3gtl9l2a4fn1j.cloudfront.net/t/p/w45";
var noimg = "'none'";

// instantiate the bloodhound suggestion engine
var movies = new Bloodhound({
    datumTokenizer: function (d) {
        return Bloodhound.tokenizers.whitespace(d.value);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        url: 'http://api.themoviedb.org/3/search/movie?query=%QUERY&api_key=ca85ff10880b1490989e8dbeb5932c00',
        filter: function (movies) {
            return $.map(movies.results, function (movie) {
                var releaseDate = movie.release_date;
                var splitDate = releaseDate.split("-"); //splits the date up
                var thumbnail = thumbnailpath+movie.poster_path;
                var popular = movie.popularity;
                return {
                    title: movie.original_title,
                    image: thumbnail,
                    year: splitDate[0],
                    popularity: popular.toFixed(2)
                };
            });
        }
    }
});

var tvshows = new Bloodhound({
    datumTokenizer: function (d) {
        return Bloodhound.tokenizers.whitespace(d.value);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        url: 'http://api.themoviedb.org/3/search/tv?query=%QUERY&api_key=ca85ff10880b1490989e8dbeb5932c00',
        filter: function (tvshows) {
            return $.map(tvshows.results, function (tvshow) {
                var airDate = tvshow.first_air_date;
                var splitDate = airDate.split("-");
                var popular = tvshow.popularity;
                return {
                    title: tvshow.name,
                    poster: tvshow.poster_path,
                    year: splitDate[0],
                    popularity: popular.toFixed(2)
                };
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
                    name: person.name,
                    photo: person.profile_path
                };
            });
        }
    }
});

movies.initialize();
people.initialize();
tvshows.initialize();

$('.auto-search .typeahead').typeahead({
  highlight: true
},
{
  name: 'movies',
  displayKey: 'title',
  source: movies.ttAdapter(),
  templates: {
    header: '<h4 class="category">Movies</h4>',
    suggestion: Handlebars.compile(
      '<div class="query-box"><img src="{{image}}" onerror="this.style.display='+noimg+'" align="left"/><span class="query-text">{{title}} ({{year}})</span</div>'
    )
  }
}
,
{
  name: 'tvshows',
  displayKey: 'title',
  source: tvshows.ttAdapter(),
  templates: {
    header: '<h4 class="category">TV Shows</h4>',
    suggestion: Handlebars.compile(
      '<div class="query-box"><img src="'+thumbnailpath+'{{poster}}" onerror="this.style.display='+noimg+'" float:left/>'+ '<span class="query-text">{{title}} ({{year}})</span></div>'
    )

  }
}
,
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
});