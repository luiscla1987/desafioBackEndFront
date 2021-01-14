import 'package:flutter/material.dart';
import 'package:share/share.dart';
import 'package:flutter_rating_bar/flutter_rating_bar.dart';

class MoviePage extends StatelessWidget {
  final Map _movieData;
  MoviePage(this._movieData);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(_movieData["title"]),
        actions: [
          IconButton(
            icon: Icon(Icons.share),
            onPressed: () {
              Share.share(_movieData["images"]["fixed_height"]["url"]);
            },
          ),
          IconButton(
            icon: Icon(Icons.person),
            onPressed: () {
              //método para logar
            },
          ),
        ],
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            Center(
              child: Padding(
                padding: EdgeInsets.only(
                  top: 30.0,
                  bottom: 15,
                ),
                child: Text(
                  _movieData["title"],
                  style: TextStyle(
                    color: Colors.green,
                    fontSize: 22.0,
                    fontWeight: FontWeight.bold,
                  ),
                  textAlign: TextAlign.center,
                ),
              ),
            ),
            Divider(),
            Center(
              child: Image.network(_movieData["images"]["fixed_height"]["url"]),
            ),
            //Rating não foi aplicado pois a api retorna um rating com string -> _movieData["rating"]
            RatingBar.builder(
              initialRating: 3,
              minRating: 1,
              direction: Axis.horizontal,
              allowHalfRating: true,
              itemCount: 5,
              itemPadding: EdgeInsets.symmetric(horizontal: 10.0),
              itemBuilder: (context, _) => Icon(
                Icons.star,
                color: Colors.green,
              ),
              onRatingUpdate: (rating) {
                //Atualiza a nota do filme caso o usuário esteja logado
              },
            ),
            SizedBox(
              height: 15.0,
            ),
            Text(
              'DESCRIPTION:',
              style: TextStyle(
                color: Colors.grey,
                fontSize: 18.0,
                fontWeight: FontWeight.bold,
              ),
            ),
            SizedBox(
              height: 10.0,
            ),
            Text(
              _movieData["slug"],
              style: TextStyle(
                fontSize: 18.0,
              ),
              textAlign: TextAlign.justify,
            ),
            Padding(
              padding: EdgeInsets.symmetric(vertical: 20.0),
              child: Row(
                children: [
                  Text(
                    'YEAR: ',
                    style: TextStyle(
                      color: Colors.black,
                      fontSize: 18.0,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  Text(
                    _movieData["import_datetime"].toString().substring(0, 4),
                    style: TextStyle(
                      color: Colors.grey,
                      fontSize: 18.0,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ],
              ),
            ),
            Padding(
              padding: EdgeInsets.only(bottom: 20.0),
              child: Row(
                children: [
                  Text(
                    'YEAR: ',
                    style: TextStyle(
                      color: Colors.black,
                      fontSize: 18.0,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  Text(
                    _movieData["username"].toString() != ""
                        ? _movieData["username"].toString().toUpperCase()
                        : "WITHOUT USER NAME",
                    style: TextStyle(
                      color: Colors.grey,
                      fontSize: 18.0,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}
