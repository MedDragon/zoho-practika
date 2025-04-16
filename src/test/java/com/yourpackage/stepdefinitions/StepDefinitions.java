import io.cucumber.java.en.Then;
import io.cucumber.java.en.When;
import io.cucumber.java.en.Given;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import static org.junit.Assert.*;

public class StepDefinitions {
    WebDriver driver = new WebDriver();  // ініціалізація WebDriver, наприклад, Selenium WebDriver

    @Given("Користувач відкриває акаунт у Zoho CRM")
    public void відкриває_акаунт_u_Zoho_CRM() {
        driver.get("URL_вашого_Zoho_акаунту");
    }

    @When("Користувач натискає кнопку для запуску віджету")
    public void натискає_кнопку_віджету() {
        WebElement widgetButton = driver.findElement(By.id("widgetButton"));  // замініть ID на реальний
        widgetButton.click();
    }

    @When("Користувач вибирає угоди з наявних")
    public void вибирає_угоди() {
        WebElement dealSelect = driver.findElement(By.id("dealSelect"));
        dealSelect.click();
        // Тут можна додати вибір конкретних угод
    }

    @Then("Повинен бути створений PDF файл з угодами")
    public void перевірити_створення_PDF() {
        // Перевірка, чи створено PDF, може бути через перевірку наявності файлу
        File pdfFile = new File("path_to_generated_pdf");
        assertTrue(pdfFile.exists());
    }

    @Then("PDF файл повинен бути прикріплений до акаунту як вкладення")
    public void перевірити_прикріплення_PDF() {
        WebElement attachment = driver.findElement(By.id("attachment"));
        assertNotNull(attachment);
        assertTrue(attachment.getText().contains("PDF"));
    }
}
