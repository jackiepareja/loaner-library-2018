console.log("WCD Asset Tool is connected");

// Add a minimum date to checkout an item. The min date should be the current date.
const currentDate = new Date().toISOString().split('T')[0];
const fullDate = new Date();
const cMonth = fullDate.getMonth() + 1;
const rDayMin = fullDate.getDate() + 1; // Return a device min 1 day
const rDayMax = fullDate.getDate() + 14; // Only able to borrow a device for 7 days
const cYear = fullDate.getYear() + 1900;

const minReturn = `${cYear}-${cMonth}-${rDayMin}`;
const maxReturn = `${cYear}-${cMonth}-${rDayMax}`;



// Setting the min for the checkout date:
//document.getElementsByName('checkout_date')[0].setAttribute('min', currentDate);
document.getElementsByName('checkout_date')[0].setAttribute('max', currentDate);

// Setting the min for checkin date:
document.getElementsByName('checkin_date')[0].setAttribute('min', minReturn);
document.getElementsByName('checkin_date')[0].setAttribute('max', maxReturn);
