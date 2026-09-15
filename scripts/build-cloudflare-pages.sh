#!/bin/sh

set -eu

deploy_dir="dist"

rm -rf -- "$deploy_dir"
mkdir -p "$deploy_dir"

for public_file in \
    404.html \
    index.html \
    arte-cultura.html \
    centro-storico.html \
    chi-siamo.html \
    citta-territori-cioccolato.html \
    cookie.html \
    guide-pdf.html \
    itinerari.html \
    museo-cioccolato.html \
    privacy.html \
    termini.html \
    robots.txt \
    sitemap.xml
do
    cp "$public_file" "$deploy_dir/"
done

cp -R assets "$deploy_dir/assets"

printf 'Cloudflare Pages artifact created in %s\n' "$deploy_dir"
