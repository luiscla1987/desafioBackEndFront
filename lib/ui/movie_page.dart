import 'package:flutter/material.dart';
import 'package:share/share.dart';

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
        ],
      ),
      body: Center(
        child: Image.network(_movieData["images"]["fixed_height"]["url"]),
      ),
    );
  }
}
