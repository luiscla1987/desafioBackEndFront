import 'package:flutter/material.dart';
import 'package:movies/ui/home_page.dart';

void main() {
  runApp(MaterialApp(
    home: HomePage(),
    debugShowCheckedModeBanner: false,
    theme: ThemeData(
      brightness: Brightness.light,
      hintColor: Colors.blue,
      primarySwatch: Colors.green,
    ),
  ));
}
