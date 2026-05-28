const amountRange = document.getElementById("loanAmount");
const amountInput = document.getElementById("loanAmountInput");
const rateRange = document.getElementById("interestRate");
const rateInput = document.getElementById("interestRateInput");
const tenureRange = document.getElementById("loanTenure");
const tenureInput = document.getElementById("loanTenureInput");
const tenureButtons = document.querySelectorAll("[data-tenure-type]");

const amountLabel = document.getElementById("loanAmountLabel");
const rateLabel = document.getElementById("interestRateLabel");
const tenureLabel = document.getElementById("loanTenureLabel");
const monthlyEmi = document.getElementById("monthlyEmi");
const principalAmount = document.getElementById("principalAmount");
const totalInterest = document.getElementById("totalInterest");
const totalPayment = document.getElementById("totalPayment");
const emiChart = document.getElementById("emiChart");
const principalPercent = document.getElementById("principalPercent");
const interestPercent = document.getElementById("interestPercent");
const principalBar = document.getElementById("principalBar");
const interestBar = document.getElementById("interestBar");

let tenureType = "years";

const formatCurrency = (value) =>
  new Intl.NumberFormat("en-IN", {
    maximumFractionDigits: 0,
  }).format(Math.round(value));

const clamp = (value, min, max) => Math.min(Math.max(Number(value) || min, min), max);

function syncInput(range, input) {
  input.value = range.value;
}

function syncRange(range, input) {
  const min = Number(range.min);
  const max = Number(range.max);
  const value = clamp(input.value, min, max);
  input.value = value;
  range.value = value;
}

function updateTenureMode(nextType) {
  tenureType = nextType;
  if (tenureType === "months") {
    tenureRange.min = 12;
    tenureRange.max = 360;
    tenureRange.step = 1;
    tenureInput.min = 12;
    tenureInput.max = 360;
    tenureInput.step = 1;
    tenureRange.value = 240;
    tenureInput.value = 240;
  } else {
    tenureRange.min = 1;
    tenureRange.max = 30;
    tenureRange.step = 1;
    tenureInput.min = 1;
    tenureInput.max = 30;
    tenureInput.step = 1;
    tenureRange.value = 20;
    tenureInput.value = 20;
  }

  tenureButtons.forEach((button) => {
    button.classList.toggle("active", button.dataset.tenureType === tenureType);
  });
  calculateEmi();
}

function calculateEmi() {
  const principal = Number(amountRange.value);
  const annualRate = Number(rateRange.value);
  const tenureValue = Number(tenureRange.value);
  const months = tenureType === "years" ? tenureValue * 12 : tenureValue;
  const monthlyRate = annualRate / 12 / 100;

  let emi = principal / months;
  if (monthlyRate > 0) {
    const multiplier = Math.pow(1 + monthlyRate, months);
    emi = principal * monthlyRate * multiplier / (multiplier - 1);
  }

  const total = emi * months;
  const interest = total - principal;
  const principalShare = total > 0 ? principal / total * 100 : 0;
  const interestShare = total > 0 ? interest / total * 100 : 0;

  amountLabel.textContent = `Rs. ${formatCurrency(principal)}`;
  rateLabel.textContent = `${annualRate}%`;
  tenureLabel.textContent = `${tenureValue} ${tenureType === "years" ? "Years" : "Months"}`;
  monthlyEmi.textContent = `Rs. ${formatCurrency(emi)}`;
  principalAmount.textContent = `Rs. ${formatCurrency(principal)}`;
  totalInterest.textContent = `Rs. ${formatCurrency(interest)}`;
  totalPayment.textContent = `Rs. ${formatCurrency(total)}`;

  emiChart.style.setProperty("--interest", `${interestShare}%`);
  principalPercent.textContent = `${Math.round(principalShare)}%`;
  interestPercent.textContent = `${Math.round(interestShare)}%`;
  principalBar.style.width = `${principalShare}%`;
  interestBar.style.width = `${interestShare}%`;
}

[
  [amountRange, amountInput],
  [rateRange, rateInput],
  [tenureRange, tenureInput],
].forEach(([range, input]) => {
  range.addEventListener("input", () => {
    syncInput(range, input);
    calculateEmi();
  });

  input.addEventListener("input", () => {
    syncRange(range, input);
    calculateEmi();
  });
});

tenureButtons.forEach((button) => {
  button.addEventListener("click", () => updateTenureMode(button.dataset.tenureType));
});

calculateEmi();
