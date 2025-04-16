package com.yourpackage.runner;  // Замість yourpackage використовуйте свій пакет

import io.cucumber.junit.Cucumber;
import io.cucumber.junit.CucumberOptions;
import org.junit.runner.RunWith;

@RunWith(Cucumber.class)
@CucumberOptions(
    features = "src/test/resources/features",  // Шлях до ваших .feature файлів
    glue = "com.yourpackage.stepdefinitions",  // Шлях до вашого пакету з Step Definitions
    plugin = {"pretty", "html:target/cucumber-report.html"}  // Для створення звітів
)
public class TestRunner {
    // Цей клас буде використовуватися для запуску тестів
}
