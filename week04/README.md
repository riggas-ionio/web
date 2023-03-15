## Τεχνολογίες Διαδικτύου - εργαστήριο #4

### JavaScript

Σκοπός του πρώτου εργαστηρίου είναι η εξοικείωση με τη γλώσσα JavaScript εντός του browser.  

#### Ενσωμάτωση κώδικα JavaScript στην html

Ο κώδικας JavaScript μπορεί να ενσωματωθεί με ποικίλους τρόπους στην html:
+ με απ' ευθείας ένθεσή του εντός μιας html περικλειόμενος σε `<script>...</script>` ετικέττες.
  + συνήθως αυτό γίνεται εντός του html `<head>`, αλλά μπορεί να γίνει και στο `<body>`
+ με αποθήκευσή του σε ανεξάρτητο `.js` αρχείο και σύνδεσή του με χρήση `<script src="..."/>` ετικέττας, όπου στο γνώρισμα `src` δίνεται ένα απόλυτο ή σχετικό url ή path
+ με συγγραφή του εντός γνωρισμάτων, όπως το `onclick` σε ετικέττες που το υποστηρίζουν, όπως πχ η `<input>`

### Microtasks εργαστηρίου

Δημιουργήστε, με κώδικα html, css & JavaScript, σελίδες που παράγουν το ακόλουθο οπτικό αποτέλεσμα και την αντίστοιχη αλληλεπίδραση, με CSS κώδικα στην κεφαλίδα της σελίδας και εξωτερικό κώδικα JavaScript:

1. [Επιλογή με βάση το id](./microtasks/01_innerHTML_by_id.png)  
    html tags: `html, head, body, h2, p`  
    JavaScript: `getElementById(), <element>.innerHTML, Date object, Date.toLocaleString()`  

    ___Ζητούμενο:___  
    * Επιλέξτε ένα html tag τύπου `p` με βάση το `id` του και προσθέστε την ημερομηνία και ώρα μορφοποιημένη στα ελληνικά με χρήση κατάλληλου js κώδικα


2. [Επιλογή με βάση το tag name](./microtasks/02_style_by_tag.png)  
    html tags: `html, head, body, p, li`  
    JavaScript: `getElementsByTagName(), <element>.style.color`  

    ___Ζητούμενο:___  
    * Επιλέξτε όλα τα html tag τύπου `li` και προσθέστε μορφοποίηση κάθε δεύτερο με χρήση κατάλληλου js κώδικα  


3. [Επιλογή με βάση την κλάση](./microtasks/03_style_by_class.gif)  
    html tags: `html, head, meta, style, script, body, p, ol, li, span`  
    css attributes: `display, color, background-color, border-radius, padding`  
    JavaScript: `getElementsByTagName(), onmouseover, onmouseout, function`  

    ___Ζητούμενο:___    
    * Εντός κάθε `li` να υπάρχει και `span` στοιχείο το οποίο να περιέχει το ποσοστό που αντιστοιχεί σε κάθε γλώσσα με μορφοποίηση (CSS class) όπως στην εικόνα, όλα τα `span` να είναι κρυμένα με χρήση του CSS attribute `display`
    * Σε όλα τα `li` με χρήση js κώδικα να προστεθεί `onmouseover` και `onmouseout` συνάρτηση η οποία να εμφανίζει και να αποκρύπτει το ποσοστό, όπως περνά το ποντίκι από πάνω, τροποποιώντας το inline css attribute `display`


4. [Έλεγχος πεδίων φόρμας](./microtasks/04_js_inputs.gif)  
    html tags: `html, head, style, script, body, p, input`  
    css attributes: `font-family, font-size, color, background-color, padding, margin, float, position`  
    JavaScript: `getElementsByTagName(), onchange, onsubmit, function, checkValidity(), <element>.classList.add, <element>.classList.remove`  

    ___Ζητούμενο:___    
    * Κάθε `input` πεδίο εντός της `form` να έχει ένα attribute με το όνομά του, μετά τη φόρμα να υπάρχουν `p` με αντίστοιχα labels με αυτά των πεδίων της φόρμας και εντός να υπάρχει `span` με `id` ίδιο με το αντίστοιχο στοιχείο της φόρμας
    * Σε κάθε `input` πεδίο να προστεθεί κώδικας για το `onchange` event, ο οποίος να εμφανίζει το περιεχόμενο του πεδίου στο αντίστοιχο `span` στοιχείο
    * Εφόσον το περιεχόμενο του πεδίου δεν είναι έγκυρο, πχ τύπος email και μήκος κωδικού, το `span` πεδίο να έχει πορτοκαλί χρώμα φόντου, διαφορετικά πράσσινο
    * Όταν η φόρμα γίνεται submit, με κατάλληλο κώδικα στο `onsubmit` event να έλεγχετε η εγκυρότητα των πεδίων και αν δεν είναι έγκυρα να εμφανίζεται σχετικό μήνυμα

### Task εβδομάδας

Δημιουργήστε ένα παιχνίδι μνήμης με πλακίδια που ανοίγουν και κλείνουν με το κλικ του ποντικιού. Να κρατάτε το χρόνο από την έναρξη του παιχνιδιού.  
Bonus: αξιοποιήστε κάποιο browser API για τοπική αποθήκευση ώστε να αποθηκεύετε τους top παίχτες και τους χρόνους τους. 

**_Help:_**
* Marijn Haverbeke, Eloquent JavaScript, 3rd edition (2018), CC BY-NC  
  https://eloquentjavascript.net
* CSS basics από Mozilla MDN  
  https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide
* JavaScript.info  
  https://javascript.info
