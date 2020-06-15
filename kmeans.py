import pandas as pd
import numpy as np

import plotly.express as px
import plotly.graph_objects as pgo
import chart_studio.plotly as py
import plotly.io as pio

import matplotlib.pyplot as plt 
from sklearn.cluster import KMeans
from sklearn.preprocessing import MinMaxScaler

air = pd.read_excel('http://localhost/PythonPHP/DataUdara.xlsx') # path to  dataset
air.head()

air = air.rename(columns={'NMHC(GT)' : 'NMHC'})
air = air.drop(["Date","Time","CO(GT)","PT08.S1(CO)","C6H6(GT)","PT08.S2(NMHC)","AH","T","PT08.S5(O3)","PT08.S4(NO2)","NO2(GT)","PT08.S3(NOx)","NOx(GT)"], axis = 1)

plt.scatter(air.NMHC , air.RH, s =10, c = "c")

air_x = air.iloc[:, 0:2]
air_x.head()
x_array = np.array(air_x)
scaler = MinMaxScaler()
x_scaled = scaler.fit_transform(x_array)
n_cluster = 5

kmeans = KMeans(n_clusters = n_cluster, random_state=123)
kmeans.fit(x_scaled)

air["kluster"] = kmeans.labels_

##Plot the K-Means Result
# output = plt.scatter(x_scaled[:,0], x_scaled[:,1], s = 100, c = air.kluster, marker = "o", alpha = 1, )
centers = kmeans.cluster_centers_
# plt.scatter(centers[:,0], centers[:,1], c='red', s=200, alpha=1 , marker="o")
# plt.title("Hasil Klustering K-Means")
# plt.colorbar (output)
# plt.show()

print("Entering new Area...")

trace0 = pgo.Scatter(x=x_scaled[:,0],
                     y=x_scaled[:,1],
                     text=air.kluster,
                     name='Member of Cluster',
                     mode='markers',
                     marker=pgo.scatter.Marker(
                                       size=26,
                                       opacity=0.8,
                                       color='Orange',
                                       line=dict(
                                            color='DarkSlateGray',
                                            width=2)
                                        ),
                     showlegend=True                     
)

trace1 = pgo.Scatter(x=centers[:, 0],
                     y=centers[:, 1],
                     name='Centroids',
                     mode='markers',
                     marker=pgo.scatter.Marker(symbol='x',
                                       size=16,
                                       color='MediumPurple'
                                        ),
                     showlegend=True
)

data7 = [trace0, trace1]

layout7 = pgo.Layout(
                     xaxis=pgo.layout.XAxis(showgrid=True,
                                     zeroline=False,
                                     showticklabels=True),
                     yaxis=pgo.layout.YAxis(showgrid=True,
                                     zeroline=False,
                                     showticklabels=True),
                     hovermode='closest')

layout7['title'] = 'Air Quality K-Means Clustering filtered by NMHC and RH'
print("Finished Rendering layout7")

fig = pgo.Figure(data=data7, layout=layout7)

try:
    pio.write_html(fig, file='kmeans.html', auto_open=False)
    print(True)
except:
    print(False) 

