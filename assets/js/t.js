let t = [1, 2, 5, 2, 9, 10];

let trie = true;
for (let i = 1; i < t.length && trie; i++) {
  if (t[i] < t[i - 1]) {
    trie = false;
  }
}

if (!trie) {
  console.log("Le tableau n'est pas trié");
} else {
  console.log("Le tableau est trié");
}
