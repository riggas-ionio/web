## Τεχνολογίες Διαδικτύου - εργαστήριο #1

### Περιβάλλον εργασίας

Σκοπός του πρώτου εργαστηρίου είναι η εγκατάσταση ενός περιβάλλοντος εργασίας το οποίο θα επιτρέπει την συγγραφή κώδικα και την προβολή του μέσω του Διαδικτύου από ένα public και live url.

Για το σκοπό αυτό, ως μια εύχρηστη λύση, προτείνεται να κάνετε δωρεάν εγγραφή στο https://ide.goorm.io .
Στη δωρεάν έκδοση το goorm IDE σας παρέχει τη δυνατότητα να στήσετε έως 5 ανεξάρτητους private containers, διαλέγοντας από ποικίλα έτοιμα stacks λογισμικού. Για το μάθημα αυτό θα αξιοποιήσουμε ένα `php` based stack.

Μετά την εγγραφή σας στο ide.goorm.io ακολουθήστε τις πιο κάτω οδηγίες για να δημιουργήσετε ένα container με τα εξής χαρακτηριστικά:
* Name: `My_web_container`
* Region: `Frankfurt` για σχετικά χαμηλό latency σε σχέση με πιο απομακρυσμένους.
* **Visibility**: `Private`
* Template: `Default Template`
* Deployment: `Not used`
* **Stack**: `PHP`
    * Template & OS τα αφήνετε ως έχουν
* Additional module/package:
    * [X] Install MySQL
    * [X] Enable mysql-ctl command
    * [ ] Install MongoDB

![Create a web container](Goorm-web-container-setup.gif)


### Δημιουργία HTML κώδικα

Ο container που δημιουργήσατε περιέχει ένα `index.php` αρχείο. Σβύστε το, με php θα δουλέψουμε σε επόμενη εβδομάδα.

Δημιουργήστε ένα νέο αρχείο `index.html` με περιεχόμενο:
```
<html>
<head>
	<title>Hello goorm</title>
</head>
<body>
	<h1>Hello goorm</h1>
	<p>
        This is my first html file!
    </p>
</body>
</html>
```

### Serving HTML κώδικα

Για να έχετε πρόσβαση μέσω ενός web browser στις ιστοσελίδες που δημιουργείτε εκτελέστε είτε από το UI του Goorm την επιλογή `new run php` (_ναι, php παρότι δουλεύουμε σε html_) ή από το terminal εκτελείτε `php -S 0.0.0.0:80 -t /workspace/My_web_container` (_εφόσον ονομάσατε `My_web_container`_ τον container σας). Το περιεχόμενό σας είνια διαθέσιμο στο URL που βρίσκεται στο μενού `PROJECT` `>` `Running URL and Port`.

![Goorm running url and port](Goorm-run.gif)

### Microtasks εργαστηρίου

Δημιουργήστε, με κώδικα html, σελίδες που παράγουν το ακόλουθο οπτικό αποτέλεσμα με χρήση των html tags που προτείνονται:

1. [απλή σελίδα](./microtasks/01_simple_html.png)  
  `html, head, title, body, p`
0. [μορφοποίηση κειμένου](./microtasks/02_text_formatting.png)  
  `html, body, p, strong, sub, sup, u, br, hr, del`
0. [μορφοποίηση επικεφαλίδων](./microtasks/03_text_headings.png)  
  `html, body, h1, h2, h3, h4, h5, h6`

    <details>
      <summary>help..</summary>
      <i>αναζητήστε το attribute <code>align</code> που μπορεί να λάβει ένα <code>h</code> tag</i>
    </details>

4. [απλή λίστα](./microtasks/04_unordered_lists.png)    
  `html, body, ul, li`

    <details>
    <summary>help..</summary>
    <i>αναζητήστε το attribute <code>type</code> που μπορεί να λάβει ένα <code>li</code> tag και το οποίο δέχεται τιμες <code>1|a|A|i|I|disc|circle|square</code></i>
    </details>

5. [ταξινομημένη λίστα](./microtasks/05_ordered_lists.png)  
  `html, body, ol, li`
0. [λίστα ορισμών](./microtasks/06_definition_lists.png)  
  `html, body, dl, dd, dt`
0. [εμφωλευμένες λίστες](./microtasks/07_nested_lists.png)  
  `html, body, ul, li`
0. [σύνδεσμοι](./microtasks/08_linking.png)  
  `html, body, h2, a`

    <details>
    <summary>help..</summary>
    <i>αναζητήστε το attribute <code>href</code> που μπορεί να λάβει ένα <code>a</code> tag
    </details>

9. [εικόνες](./microtasks/09_images.png)  
  `html, body, img`  

    <details>
    <summary>help..</summary>
    <i>αναζητήστε τα attributes <code>src, width, height</code> που μπορεί να λάβει ένα <code>img</code> tag
    </details>

10. [απλός πίνακας](./microtasks/10_simple_tables.png)  
  `html, body, h1, caption, table, tr, th, td`
0. [σύνθετος πίκανας](./microtasks/11_complex_table.png)  
  `html, body, h1, caption, table, tr, th, td`

    <details>
    <summary>help..</summary>
    <i>αναζητήστε τα attributes <code>colspan, rowspan</code> που μπορεί να λάβει ένα <code>th ή td</code> tag
    </details>

12. [πιο σύνθετος πίκανας](./microtasks/12_complex_table_2.png)   
  `html, body, caption, table, tr, th, td, h1`
0. [απλή φόρμα](./microtasks/14_simple_form.png)  
  `html, body, form, input`

    <details>
    <summary>help..</summary>
    <i>αναζητήστε τα attributes <code>name, type, value</code> που μπορεί να λάβει ένα <code>input</code> tag
    </details>

14. [φόρμα με πεδίο κειμένου](./microtasks/15_simple_form_2.png)  
  `html, body, form, input, textarea`
0. [φόρμα με κλειστές επιλογές](./microtasks/16_simple_form_3.png)  
  `html, body, form, input, select, option`

### Task εβδομάδας

Δημιουργήστε το βιογραφικό σας με έκδοση html και με όνομα αρχείου cv.html, αξιοποιώντας διάφορα επίπεδα heading, παραγράφους, λίστες (αριθμημένες και μη), συνδέσμους και μία τουλάχιστον εικόνα (_μη χρησιμοποιήσετε την πραγματική φώτο σας_). Εκτελέστε τον εξυπηρετητή ιστοσελίδων (εντολή php πιο πάνω) και προσπελάστε το βιογραφικό σας από ένα άλλο γειτονικό υπολογιστή και το κινητό σας τηλέφωνο.

**_Help:_**
* Εργαστηριακές ασκήσεις δικτύων Η/Υ, **Εισαγωγή στην HTML**, Κωνσταντίνος Χειλάς, Αλέξανδρος Βακαλούδης, Αναστάσιος Πολίτης  
  https://repository.kallipos.gr/handle/11419/1773?&locale=el
* HTML basics από από Mozilla MDN  
  https://developer.mozilla.org/en-US/docs/Learn/Getting_started_with_the_web/HTML_basics
* HTML Cheatsheet από stanford.edu
 https://web.stanford.edu/group/csp/cs21/htmlcheatsheet.pdf
