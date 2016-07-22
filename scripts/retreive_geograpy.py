from __future__ import unicode_literals
import csv
import geograpy

h_file = open('hurricanes.csv')
o_file = open('computed_areas_geograpy.csv', 'wb')

hurricanes = csv.reader(h_file)

# Create Writer Object
wr = csv.writer(o_file, dialect='excel')

for row in hurricanes:
  h_uri = str(row[0])
  h_abstract = str(row[1]).decode('utf-8', 'ignore')
  
  places = geograpy.get_place_context(text=h_abstract)
  
  countries = list(set(places.countries))
  regions = list(set(places.regions))
  
  #print('Row #' + str(hurricanes.line_num) + ' ' + str(places.countries) + ' ' + str(places.regions) + ' ' + str(places.cities) + ' ' + str(places.other))
#   print('Row #' + str(hurricanes.line_num) + ' ' + str(countries) + ' ' + str(regions))
  
  if len(countries) != 0 :
    print('Countries: ')
    for country in countries:
      print(country)
      wr.writerow([h_uri, country])
  
  if len(regions) != 0 :
    print('Regions: ')
    for region in regions:
      print(region)
      wr.writerow([h_uri, region])

o_file.close();
